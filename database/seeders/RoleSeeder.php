<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     // creacion de roles   
      $role_supradmin =  Role::create(['name' => 'supradmin']);
      $role_administrator =  Role::create(['name' => 'administrator']);
      $role_employee_area =  Role::create(['name' => 'employee_area']);
      $role_management =  Role::create(['name' => 'management']);

      /* 
      Creacion de permisos
      */
      
      // Permiso CRUD para Roles 
      $permission_create_role = Permission::create(['name' => 'create_role']);
      $permission_read_role = Permission::create(['name' => 'read_role']);
      $permission_update_role = Permission::create(['name' => 'update_role']);
      $permission_delete_role = Permission::create(['name' => 'delete_role']);

       // Permiso CRUD para  clinica 
       $permission_create_clinic = Permission::create(['name' => 'create_clinic']);
       $permission_read_clinic = Permission::create(['name' => 'read_clinic']);
       $permission_update_clinic = Permission::create(['name' => 'update_clinic']);
       $permission_delete_clinic = Permission::create(['name' => 'delete_clinic']);

       // Permiso CRUD para  surcusales (Branches) 
       $permission_create_branch = Permission::create(['name' => 'create_branch']);
       $permission_read_branch = Permission::create(['name' => 'read_branch']);
       $permission_update_branch = Permission::create(['name' => 'update_branch']);
       $permission_delete_branch = Permission::create(['name' => 'delete_branch']);
 
        // Permiso CRUD para  Servicios (Services) 
       $permission_create_service = Permission::create(['name' => 'create_service']);
       $permission_read_service= Permission::create(['name' => 'read_service']);
       $permission_update_service = Permission::create(['name' => 'update_service']);
       $permission_delete_service = Permission::create(['name' => 'delete_service']);
      

        // Permiso CRUD para  Positions  
       $permission_create_position = Permission::create(['name' => 'create_position']);
       $permission_read_position = Permission::create(['name' => 'read_position']);
       $permission_update_position = Permission::create(['name' => 'update_position']);
       $permission_delete_position = Permission::create(['name' => 'delete_position']);

       // Permiso CRUD para  Employees   
       $permission_create_employee = Permission::create(['name' => 'create_employee']);
       $permission_read_employee = Permission::create(['name' => 'read_employee']);
       $permission_update_employee = Permission::create(['name' => 'update_employee']);
       $permission_delete_employee = Permission::create(['name' => 'delete_employee']);

       // Permiso CRUD para  Horarios (schedule)   
       $permission_create_schedule = Permission::create(['name' => 'create_schedule']);
       $permission_read_schedule = Permission::create(['name' => 'read_schedule']);
       $permission_update_schedule = Permission::create(['name' => 'update_schedule']);
       $permission_delete_schedule = Permission::create(['name' => 'delete_schedule']);

       // Permiso CRUD para  Pacientes (patient)   
       $permission_create_patient = Permission::create(['name' => 'create_patient']);
       $permission_read_patient = Permission::create(['name' => 'read_patient']);
       $permission_update_patient = Permission::create(['name' => 'update_patient']);
       $permission_delete_patient = Permission::create(['name' => 'delete_patient']);
  
       // Permiso CRUD para  Promociones (promotion)   
       $permission_create_promotion = Permission::create(['name' => 'create_promotion']);
       $permission_read_promotion = Permission::create(['name' => 'read_promotion']);
       $permission_update_promotion = Permission::create(['name' => 'update_promotion']);
       $permission_delete_promotion = Permission::create(['name' => 'delete_promotion']);

       // Permiso CRUD para  paquetes (package)   
       $permission_create_package = Permission::create(['name' => 'create_package']);
       $permission_read_package = Permission::create(['name' => 'read_package']);
       $permission_update_package = Permission::create(['name' => 'update_package']);
       $permission_delete_package = Permission::create(['name' => 'delete_package']);

        // Permiso CRUD para  consultas (consultation)   
        $permission_create_consultation = Permission::create(['name' => 'create_consultation']);
        $permission_read_consultation = Permission::create(['name' => 'read_consultation']);
        $permission_update_consultation = Permission::create(['name' => 'update_consultation']);
        $permission_delete_consultation = Permission::create(['name' => 'delete_consultation']);

        // Permiso CRUD para  tipos de pagos  (method_type)   
        $permission_create_method_type = Permission::create(['name' => 'create_method_type']);
        $permission_read_method_type = Permission::create(['name' => 'read_method_type']);
        $permission_update_method_type = Permission::create(['name' => 'update_method_type']);
        $permission_delete_method_type = Permission::create(['name' => 'delete_method_type']);


        // Permiso CRUD para  metodos de pagos  (payment_method)   
        $permission_create_payment_method = Permission::create(['name' => 'create_payment_method']);
        $permission_read_payment_method = Permission::create(['name' => 'read_payment_method']);
        $permission_update_payment_method = Permission::create(['name' => 'update_payment_method']);
        $permission_delete_payment_method = Permission::create(['name' => 'delete_payment_method']);


        // Permiso CRUD para  pagos  (payment)   
        $permission_create_payment = Permission::create(['name' => 'create_payment']);
        $permission_read_payment = Permission::create(['name' => 'read_payment']);
        $permission_update_payment = Permission::create(['name' => 'update_payment']);
        $permission_delete_payment = Permission::create(['name' => 'delete_payment']);



     /*
     * Permisos por Roles de usuarios
     */   

     $permissions_supradmin = [
        $permission_create_role,
        $permission_read_role,
        $permission_update_role,
        $permission_delete_role,
        $permission_create_clinic,
        $permission_read_clinic,
        $permission_update_clinic,
        $permission_delete_clinic,
        $permission_create_branch,
        $permission_read_branch,
        $permission_update_branch,
        $permission_delete_branch,
        $permission_create_service,
        $permission_read_service,
        $permission_update_service,
        $permission_delete_service,
        $permission_create_position,
        $permission_read_position,
        $permission_update_position,
        $permission_delete_position,
        $permission_create_employee,
        $permission_read_employee,
        $permission_update_employee,
        $permission_delete_employee,
        $permission_create_schedule,
        $permission_read_schedule,
        $permission_update_schedule,
        $permission_delete_schedule,
        $permission_create_patient,
        $permission_read_patient,
        $permission_update_patient,
        $permission_delete_patient,
        $permission_create_promotion,
        $permission_read_promotion,
        $permission_update_promotion,
        $permission_delete_promotion,
        $permission_create_package,
        $permission_read_package,
        $permission_update_package,
        $permission_delete_package,
        $permission_create_consultation,
        $permission_read_consultation,
        $permission_update_consultation,
        $permission_delete_consultation,
        $permission_create_method_type,
        $permission_read_method_type,
        $permission_update_method_type,
        $permission_delete_method_type,
        $permission_create_payment_method,
        $permission_read_payment_method,
        $permission_update_payment_method,
        $permission_delete_payment_method,
        $permission_create_payment,
        $permission_read_payment,
        $permission_update_payment,
        $permission_delete_payment
     ];

     $permissions_administrator = [
     
        $permission_read_role,
        $permission_read_clinic,

        //$permission_create_branch,
        $permission_read_branch,
        //$permission_update_branch,
        //$permission_delete_branch,

       // $permission_create_service,
        $permission_read_service,
       // $permission_update_service,
       // $permission_delete_service,

       // $permission_create_position,
        $permission_read_position,
       // $permission_update_position,
       // $permission_delete_position,

        $permission_create_employee,
        $permission_read_employee,
        $permission_update_employee,
        $permission_delete_employee,

        $permission_create_schedule,
        $permission_read_schedule,
        $permission_update_schedule,
        $permission_delete_schedule,

        $permission_create_patient,
        $permission_read_patient,
        $permission_update_patient,
        $permission_delete_patient,

        $permission_create_promotion,
        $permission_read_promotion,
        $permission_update_promotion,
        $permission_delete_promotion,

        $permission_create_package,
        $permission_read_package,
        $permission_update_package,
        $permission_delete_package,

        $permission_create_consultation,
        $permission_read_consultation,
        $permission_update_consultation,
        $permission_delete_consultation,

        $permission_create_method_type,
        $permission_read_method_type,
        $permission_update_method_type,
        $permission_delete_method_type,

        $permission_create_payment_method,
        $permission_read_payment_method,
        $permission_update_payment_method,
        $permission_delete_payment_method,
        $permission_create_payment,
        $permission_read_payment,
        $permission_update_payment,
        $permission_delete_payment
     ];


     $permissions_employee_area = [
     
        $permission_read_role,
        $permission_read_clinic,
        $permission_read_branch,
        $permission_read_service,
        $permission_read_position,
        $permission_read_schedule,
        $permission_update_schedule,
        $permission_read_patient,
        $permission_read_consultation,
        $permission_update_consultation,
   
     ];
     $permissions_role_management = [
        
        $permission_read_clinic,
        $permission_read_branch,
        $permission_read_service,
        $permission_read_position,
        $permission_read_employee,
        $permission_read_schedule,
        $permission_read_patient,
        $permission_read_promotion,
        $permission_read_package,
        $permission_read_consultation,
        $permission_read_method_type,
        $permission_read_payment_method,
        $permission_read_payment,
     ];


 /*
 * Sicronizar los permisos con los roles a traves de spatie
 */

  $role_supradmin->syncPermissions($permissions_supradmin);
  $role_administrator->syncPermissions($permissions_administrator);
  $role_employee_area->syncPermissions($permissions_employee_area);  
  $role_management->syncPermissions($permissions_role_management); 

    }
}
