<?php
$pathDir = pathinfo(dirname(__DIR__));
define("__ROOT_PATH__", $pathDir['dirname']);
//define("__FRAMEWORK_ROOT_PATH__", "/home/liuqi/www/wl_framework");
define("__FRAMEWORK_ROOT_PATH__", __ROOT_PATH__."/system");
define("__APP_ROOT_PATH__", __ROOT_PATH__ . DIRECTORY_SEPARATOR . 'app');

define("__APP_MODEL_PATH__", __APP_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'model');
define("__APP_CONF_PATH__", __APP_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'conf');

define('__FRAMEWORK_CONF_PATH__', __FRAMEWORK_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'conf');
define('__FRAMEWORK_CORE_PATH__', __FRAMEWORK_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'core');
define('__FRAMEWORK_HELPERS_PATH__', __FRAMEWORK_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'helpers');
define('__FRAMEWORK_DATABASE_PATH__', __FRAMEWORK_ROOT_PATH__ . DIRECTORY_SEPARATOR . 'database');
define('__FRAMEWORK_DATABASE_DRIVES_PATH__', __FRAMEWORK_DATABASE_PATH__ . DIRECTORY_SEPARATOR . 'db_drives');

require_once __FRAMEWORK_HELPERS_PATH__ . DIRECTORY_SEPARATOR . "functions.php";
require_once __FRAMEWORK_DATABASE_PATH__ . DIRECTORY_SEPARATOR . "model.php";
foreach (glob(__FRAMEWORK_DATABASE_DRIVES_PATH__. DIRECTORY_SEPARATOR . '*.php') as $file) {
    require_once $file;
}

$GLOBALS['config'] = include_once __DIR__ . DIRECTORY_SEPARATOR ."config.php";

use \Model\Model;
class GeneratorTables extends Model
{
    /**
     * 读取数据库表结构
     * @throws Exception
     */
    public function loadTables()
    {
        try {
            if ($this->db->dbConf['dbname']) {
                $buildInfo = array();
                $tablesCache = __APP_MODEL_PATH__ . DIRECTORY_SEPARATOR .  'static.tables.php';
                //解析数据库表结构
                $tables = $this->parseTables($this->db->dbConf['dbname']);
                ob_start();
                echo '<?php ';
                echo "\r\n";
                echo 'return ';
                var_export($tables);
                $tablesCode = ob_get_clean() . ';';
                /*if (!is_writable($tablesCache)) {
                    throw new \Exception("文件或目录不可写！");
                }*/
                if (false !== file_put_contents($tablesCache, $tablesCode))
                    $info = array('state' => 'success', 'name' => $tablesCache);

                else
                    $info = array('state' => 'error', 'name' => $tablesCache);
                $buildInfo[] = $info;
                //生成模型文件
                $modelFiles = array_keys($tables);
                $preSub = C("DB_PREFIX");//获取表名的前缀
                foreach ($modelFiles as $model) {
                    $psrName = '';//model类文件的名
                    $className = '';//class类名
                    $replacePsr = str_replace($preSub, "", $model);//去掉表名前缀
                    $psrArr = explode("_", $replacePsr);
                    foreach ($psrArr as $value) {
                        $psrName .= strtolower($value);
                        $className .= ucfirst($value);
                    }
                    $modelfile = __APP_MODEL_PATH__ . DIRECTORY_SEPARATOR  . $psrName . '.php';
                    //fopen($modelfile,"r+");
                    if (!file_exists($modelfile)) {
                        $phpTpl = <<<'TPL'
<?php
namespace Model;
class :classname extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct(':tablename');
        if ($pkVal)
            $this->initArData($pkVal);
    }
}
TPL;
                        $phpCode = str_replace(array(':classname', ':tablename'), array($className, $replacePsr), $phpTpl);

                        file_put_contents($modelfile, $phpCode);
                        $info = array('state' => 'success', 'name' => $modelfile);
                        $buildInfo[] = $info;

                    } else {
                        $info = array('state' => 'continue', 'name' => $modelfile);
                        $buildInfo[] = $info;
                    }
                }
                return $buildInfo;

            } else
                throw new \Exception('数据库名称未配置，或使用的数据库不存在');

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

$generatorTbale = new GeneratorTables();

$buildInfo = $generatorTbale->loadTables();
if (is_array($buildInfo) && !empty($buildInfo)) {
    $br = php_sapi_name() == 'cli' ? PHP_EOL : '<br />';
    foreach ($buildInfo as $row) {
        echo $row['name'];
        echo $br;
        echo $row['state'];
        echo $br;
    }
}
