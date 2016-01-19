<?php

class IvaTableSeeder extends Seeder {
 
    public function run()
    {
 		date_default_timezone_set('America/Caracas');
         DB::table('impuesto')->insert(array(
            'iva'           =>  '10',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '1994-08-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '12.5',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '1995-01-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '16.5',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '1996-08-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '15.5',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '1999-06-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '14.5',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2000-08-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '16',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2002-09-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '15',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2004-09-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '14',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2005-10-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '11',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2007-03-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '9',
            'estatus'       =>  'vencido',
            'vigencia'      =>  '2007-07-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));

        DB::table('impuesto')->insert(array(
            'iva'           =>  '12',
            'estatus'       =>  'actual',
            'vigencia'      =>  '2009-04-01',
            'id_user'       =>  1,
            'update_user'   =>  1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ));
    }
}