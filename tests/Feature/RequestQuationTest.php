<?php

namespace Tests\Feature;

use App\Model\Quatataion;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestQuationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function make_quatation_request(){
          
         $this->withoutExceptionHandling();
         
        $response = $this->post('/insertQuatation', [
            'fullname' => 'Mark Dave Panado',
            'company' => 'intern company',
            'address' => 'Quezon City',
            'contact' => '04589459',
            'description' => 'This is a Test Description'
        ]);
        
        $response->assertOk();

        $this->assertCount(1,Quatataion::all());
    }
}
