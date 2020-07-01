import Wellcome from './components/Wellcome.vue';
import Legal from './components/Legal.vue';
import Home from './components/Home.vue';
import Main from './components/Main.vue';
import st404 from './components/shared/404.vue';

import UserIndex from './components/admin/users/UserIndex.vue';
import UserCreate from './components/admin/users/UserCreate.vue';
import UserEdit from './components/admin/users/UserEdit.vue';
import RolesIndex from './components/admin/roles/RolesIndex.vue';
import RolesCreate from './components/admin/roles/RolesCreate.vue';
import RolesEdit from './components/admin/roles/RolesEdit.vue';


import EmpresaIndex from './components/admin/empresas/EmpresaIndex.vue';
import EmpresaCreate from './components/admin/empresas/EmpresaCreate.vue';
import EmpresaEdit from './components/admin/empresas/EmpresaEdit.vue';

import AlmacenIndex from './components/mto/almacen/AlmacenIndex.vue';
import AlmacenCreate from './components/mto/almacen/AlmacenCreate.vue';
import AlmacenEdit from './components/mto/almacen/AlmacenEdit.vue';


import IvaIndex from './components/mto/iva/IvaIndex.vue';
import IvaCreate from './components/mto/iva/IvaCreate.vue';
import IvaEdit from './components/mto/iva/IvaEdit.vue';

import BonoIndex from './components/mto/bonos/BonoIndex.vue';
import BonoCreate from './components/mto/bonos/BonoCreate.vue';
import BonoEdit from './components/mto/bonos/BonoEdit.vue';

import TratamientoIndex from './components/mto/tratamientos/TratamientoIndex.vue';
import TratamientoCreate from './components/mto/tratamientos/TratamientoCreate.vue';
import TratamientoEdit from './components/mto/tratamientos/TratamientoEdit.vue';
import EmpleadoIndex from './components/mto/empleados/EmpleadoIndex.vue';
import EmpleadoCreate from './components/mto/empleados/EmpleadoCreate.vue';
import EmpleadoEdit from './components/mto/empleados/EmpleadoEdit.vue';

import CajaIndex from './components/mto/cajas/CajaIndex.vue';
import CajaEdit from './components/mto/cajas/CajaEdit.vue';
import CajaCreate from './components/mto/cajas/CajaCreate.vue';
import CajaCierre from './components/mto/cajas/CajaCierre.vue';


import ParametroEdit from './components/admin/parametros/ParametroEdit.vue';
import EditPassword from './components/profile/edit-password/EditPassword.vue';


export default [
	{
		path: '/',
		name: 'index',
		component: Wellcome
    },
    {
		path: '/legal',
		name: 'legal',
		component: Legal
    },
	{
		path: '/login',
		name: 'login'
    },
    {
		path: '/password/reset',
		name: 'password.reset'
    },
	{
        path: '/home',
        component: Home,
        children: [
            {
				path: '',
				name: 'dash',
                component: Main,
            },
            {
                path: '/users',
                name: 'users.index',
                component: UserIndex,
            },
            {
                path: '/users/create',
                name: 'users.create',
                component: UserCreate,
            },
            {
                path: '/users/:id/edit',
                name: 'users.edit',
                component: UserEdit,
            },
            {
                path: '/roles',
                name: 'roles',
                component: RolesIndex,
            },
            {
                path: '/roles/create',
                name: 'roles_create',
                component: RolesCreate,
            },
            {
                path: '/roles/:id/edit',
                name: 'roles_edit',
                component: RolesEdit,
            },
            {
                path: '/users/password',
                name: 'edit.password',
                component: EditPassword,
            },
            {
                path: '/empresas',
                name: 'empresa.index',
                component: EmpresaIndex,
            },
            {
                path: '/empresas/create',
                name: 'empresa.create',
                component: EmpresaCreate,
            },
            {
                path: '/empresas/:id/edit',
                name: 'empresa.edit',
                component: EmpresaEdit,
            },
            {
                path: '/almacenes',
                name: 'almacen.index',
                component: AlmacenIndex,
            },
            {
                path: '/almacenes/create',
                name: 'almacen.create',
                component: AlmacenCreate,
            },
            {
                path: '/almacenes/:id/edit',
                name: 'almacen.edit',
                component: AlmacenEdit,
            },
            {
                path: '/ivas',
                name: 'iva.index',
                component: IvaIndex,
            },
            {
                path: '/ivas/create',
                name: 'iva.create',
                component: IvaCreate,
            },
            {
                path: '/ivas/:id/edit',
                name: 'iva.edit',
                component: IvaEdit,
            },
            {
                path: '/cajas',
                name: 'caja.index',
                component: CajaIndex,
            },
            {
                path: '/cajas/create',
                name: 'caja.create',
                component: CajaCreate,
            },
            {
                path: '/caja/:id/edit',
                name: 'caja.edit',
                component: CajaEdit,
            },
            {
                path: '/cajas/cierre',
                name: 'caja.cierre',
                component: CajaCierre,
            },
            {
                path: '/bonos',
                name: 'bono.index',
                component: BonoIndex,
            },
            {
                path: '/bonos/create',
                name: 'bono.create',
                component: BonoCreate,
            },
            {
                path: '/bonos/:id/edit',
                name: 'bono.edit',
                component: BonoEdit,
            },
            {
                path: '/tratamientos',
                name: 'tratamiento.index',
                component: TratamientoIndex,
            },
            {
                path: '/tratamientos/create',
                name: 'tratamiento.create',
                component: TratamientoCreate,
            },
            {
                path: '/tratamientos/:id/edit',
                name: 'tratamiento.edit',
                component: TratamientoEdit,
            },
            {
                path: '/empleados',
                name: 'empleado.index',
                component: EmpleadoIndex,
            },
            {
                path: '/empleados/create',
                name: 'empleado.create',
                component: EmpleadoCreate,
            },
            {
                path: '/empleados/:id/edit',
                name: 'empleado.edit',
                component: EmpleadoEdit,
            },
            // {
            //     path: '*',
            //     redirect: {
            //         name: 'index'
            //     }
            // }
        ]
    },
    {
        path: '*',
        name: '404',
        component: st404,
    }
];
