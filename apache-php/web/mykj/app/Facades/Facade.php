<?php


namespace App\Facades;

//����,��ʵ���ǣ���appʵ����ͨ����ʶ�ҵ�����
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
    //     throw new Exception('û��ָ��facade ָ����ʵ������', 500);
    // }

    protected static function resolveFacadeInstance($object) //����������$object = 'mysql' �ַ�������
    {
        // �ж��Ƿ�Ϊ����
        if (\is_object($object)) {
            return $object;
        }
        // �ж��Ƿ�֮ǰ������
        if (isset(static::$resolvedInstances[$object] )) {
            return static::$resolvedInstances[$object];
        }
        // ����ʵ�����󣬴�������ȡ����������������$object = mysql,rotue��
         return static::$resolvedInstances[$object] = app($object);

      //  return static::$resolvedInstances[$object] = static::$app['instances'][$object]; //˭new˭����static,����new mysql()�� static ��ֵ���� mysql
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
        //tp5.1�ķ�ʽִ��ʵ�ʷ���
        //return call_user_func_array([$class,$method],...$params);
        //laralve��ʽ ��
        $instance = static::getFacadeRoot();
        // var_dump($instance);
        if (! $instance) {
            checkException('�Բ���û���ҵ��ɽ�����ʵ���������� facade �е� getFacadeAccessor ��������');
        }

        return $instance->$method(...$params);

    }
    /*��������������������*/
    public static function clearResolvedInstance($name) {
        unset (static::$resolvedInstances[$name]);
    }
}