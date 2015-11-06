<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\UserProfile;
use App\User;
use App\Device;
use App\Session;
use App\RolePermission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        
        DB::table('user_profiles')->delete();
        
        $profile1=array("name"=>"admin");
        $profile2=array("name"=>"operator");
        $profile3=array("name"=>"doctor");
        $profile4=array("name"=>"user");
        
        $up1=UserProfile::create($profile1);
        $up2=UserProfile::create($profile2);
        $up3=UserProfile::create($profile3);
        $up4=UserProfile::create($profile4);
        
        
        DB::table('role_permissions')->delete();
        
        
        //operator
        $rp=array('profileid'=>$up2->getKey(),'permission'=>'r','action'=>'Home');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up2->getKey(),'permission'=>'r','action'=>'Devices');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up2->getKey(),'permission'=>'r','action'=>'Sessions');
        RolePermission::create($rp);
        //doctor
        $rp=array('profileid'=>$up3->getKey(),'permission'=>'r','action'=>'Home');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up3->getKey(),'permission'=>'r','action'=>'Devices');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up3->getKey(),'permission'=>'r','action'=>'Sessions');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up3->getKey(),'permission'=>'r','action'=>'Users');
        RolePermission::create($rp);
        
        //user
        $rp=array('profileid'=>$up4->getKey(),'permission'=>'r','action'=>'Home');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up4->getKey(),'permission'=>'r','action'=>'Devices');
        RolePermission::create($rp);
        $rp=array('profileid'=>$up4->getKey(),'permission'=>'r','action'=>'Sessions');
        RolePermission::create($rp);
        
        
        DB::table('users')->delete();
        
       
        $p=array("name"=>"admin",
        "lastname"=>"admin",
        "username"=>"admin",
        "password"=>Hash::make('admin'),
        "email"=>"emanuele.admin@gmail.com",
        "profileid"=>$up1->getAttribute("id")
        );
        
        
        User::create($p);
        
        $p=array("name"=>"oper1",
        		"lastname"=>"oper1",
        		"username"=>"oper1",
        		"password"=>Hash::make('oper1'),
        		"email"=>"emanuele.oper1@gmail.com",
        		"profileid"=>$up2->getAttribute("id")
        );
        User::create($p);
        
        $p=array("name"=>"doctor1",
        		"lastname"=>"doctor1",
        		"username"=>"doctor1",
        		"password"=>Hash::make('doctor1'),
        		"email"=>"emanuele.doctor1@gmail.com",
        		"profileid"=>$up3->getAttribute("id")
        );
        User::create($p);
        
        $puser1=array("name"=>"user1",
        		"lastname"=>"user1",
        		"username"=>"user1",
        		"password"=>Hash::make('user1'),
        		"email"=>"emanuele.user1@gmail.com",
        		"profileid"=>$up4->getAttribute("id")
        );
        $user1=User::create($puser1);
        
        $puser2=array("name"=>"user2",
        		"lastname"=>"user2",
        		"username"=>"user2",
        		"password"=>Hash::make('user2'),
        		"email"=>"emanuele.user2@gmail.com",
        		"profileid"=>$up4->getAttribute("id")
        );
        $user2=User::create($puser2);
        
        
       
        
        DB::table('devices')->delete();
        $device=array('deviceid'=>'dev1',
        		'status'=>'a',
        		'userid'=>$user1->getKey()
        );
        $device1=Device::create($device);
        
        
        
        $device=array('deviceid'=>'dev2',
        		'status'=>'a',
        		'userid'=>$user2->getKey()
        );
        $device2=Device::create($device);
        
        
       	DB::table('sessions')->delete();
        $s=array('sessionid'=>'Session 1',
        		'deviceid'=>$device1->getKey(),
        		'userid'=>$user1->getKey(),
        		'elapsed'=>4978
        );
        Session::create($s);
        
         $s=array('sessionid'=>'Session 2',
        		'deviceid'=>$device1->getKey(),
        		'userid'=>$user1->getKey(),
        		'elapsed'=>4978
        );
        Session::create($s);
        
        $s=array('sessionid'=>'Session a',
        		'deviceid'=>$device2->getKey(),
        		'userid'=>$user2->getKey(),
        		'elapsed'=>4978
        );
        Session::create($s);
        
        $s=array('sessionid'=>'Session b',
        		'deviceid'=>$device2->getKey(),
        		'userid'=>$user2->getKey(),
        		'elapsed'=>4978
        );
        Session::create($s);
        
        
        Model::reguard();
    }
}
