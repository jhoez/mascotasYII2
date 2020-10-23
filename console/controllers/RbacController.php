<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * @class RbacController
 */
class RbacController extends Controller
{
    // ejecutar el comando php yii rbac/init
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // PERMISO "permisoAdministrador"
        $permisoadministrador = $auth->createPermission('permisoAdministrador');
        $auth->add($permisoadministrador);
        // PERMISO "permisoFuncionario"
        $permisofuncionario = $auth->createPermission('permisoFuncionario');
        $auth->add($permisofuncionario);
        // ROLE "administrador" y le asigna el permiso "permisoAdministrador"
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);
        $auth->addChild($administrador, $permisoadministrador);
        // ROLE "funcionario" y le asigna el permiso "permisoFuncionario"
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $permisofuncionario);
        // asigna role administrador, ID 10 devuelto por IdentityInterface::getId()
        $auth->assign($administrador, 10);
    }
}


?>
