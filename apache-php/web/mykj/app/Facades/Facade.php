<?php


namespace App\Facades;

//门面,其实就是，到app实例中通过标识找到容器
abstract class Facade
{
    protected static $app;
    protected static $resolvedInstances = [];

    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    protected abstract static function getFacadeAccessor();
    // protected static function getFacadeAccessor()
    // {
    //     throw new Exception('没有指明facade 指定的实例对象', 500);
    // }

    protected static function resolveFacadeInstance($object) //比如这里是$object = 'mysql' 字符串类型
    {
        // 判断是否为对象
        if (\is_object($object)) {
            return $object;
        }
        // 判断是否之前创建过
        if (isset(static::$resolvedInstances[$object] )) {
            return static::$resolvedInstances[$object];
        }
        // 解析实例对象，从容器中取出功能类来（比如$object = mysql,rotue）
         return static::$resolvedInstances[$object] = app($object);

      //  return static::$resolvedInstances[$object] = static::$app['instances'][$object]; //谁new谁就是static,比如new mysql()类 static 的值就是 mysql
    }
    /**
     * Get the application instance behind the facade.
     *
     * @return \LaravelStar\Foundation\Application
     */
    /*public static function getFacadeApplication()
    {
        return static::$app;
    }*/

    /**
     * Set the application instance.
     *
     * @param  \LaravelStar\Foundation\Application  $app
     * @return void
     */
    /*public static function setFacadeApplication($app)
    {
        static::$app = $app;
    }*/

    public static function __callStatic($method, $params = [])
    {
        //tp5.1的方式执行实际方法
        //return call_user_func_array([$class,$method],...$params);
        //laralve方式 ：
        $instance = static::getFacadeRoot();
        // var_dump($instance);
        if (! $instance) {
            checkException('对不起，没有找到可解析的实例对象，请检查 facade 中的 getFacadeAccessor 方法设置');
        }

        return $instance->$method(...$params);

    }
    /*定义门面里面的容器清空*/
    public static function clearResolvedInstance($name) {
        unset (static::$resolvedInstances[$name]);
    }
}