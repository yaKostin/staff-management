<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Position;

class UsersTableSeeder extends Seeder
{
    private $faker;
    private $password;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $this->password = bcrypt('password');
        $chiefPosition = Position::first();
        $chiefSalary = 100000;        
        $chief = $this->createFakeUser($chiefSalary, $chiefPosition->id);
        $chief->makeRoot();
        
        $this->createUserDescendants($chiefPosition, $chief);
    }

    public function createUserDescendants($rootPosition, $rootUser) 
    {
        $minSalaryPerLevel = 8000;
        $maxSalaryPerLevel = 10000;
        $salary = ($rootPosition->depth + 1) * rand($minSalaryPerLevel, $maxSalaryPerLevel);
        if ($rootPosition->isLeaf()) 
        {
            return;
        }
        // else 
        $usersPerPositionMaxCount = 2;
        $positions = $rootPosition->getImmediateDescendants();
        foreach ($positions as $position) 
        {
            if ($position->isLeaf())
            {
                $usersPerPositionMaxCount = 3;    
            }
            for ($i = 0; $i < $usersPerPositionMaxCount; $i++)
            {
                $user = $this->createFakeUser($salary, $position->id);
                $user->makeChildOf($rootUser);
                $this->createUserDescendants($position, $user);
            }
        }
    }

    public function createFakeUser($salary, $position_id) 
    {
    	$user = User::create([
    		'name' => $this->faker->firstName,
    		'surname' => $this->faker->lastName,
    		'patronymic' => $this->faker->title . $this->faker->suffix,
    		'salary' => $salary,
    		'position_id' => $position_id,
    		'hire_date' => $this->faker->date,
            // use str_random instead 'email' faker field to create unique address
    		'email' => str_random(10) . '@gmail.com', 
    		'password' => $this->password,
    		]);
    	return $user;
    }
}