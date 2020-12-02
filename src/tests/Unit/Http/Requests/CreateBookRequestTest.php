<?php

namespace Tests\Requests;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateBookRequest;

class CreateBookRequestTest extends TestCase
{
    public function testValid()
    {
        $givenParams = [
            'author_id' => 10,
            'title'     => 'first PHP'
        ];
        $validator = $this->createValidator($givenParams);
        $this->assertTrue($validator->passes());
    }

    public function testInvalidWhenAuthorIdIsString()
    {
        $givenParams = [
            'author_id' => 'invalid',
            'title'     => 'first PHP'
        ];
        $validator = $this->createValidator($givenParams);
        $this->assertFalse($validator->passes());
    }

    public function testInvalidWhenTitleIsEmpty()
    {
        $givenParams = [
            'author_id' => 10,
            'title'     => ''
        ];
        $validator = $this->createValidator($givenParams);
        $this->assertFalse($validator->passes());
    }

    private function createValidator(array $givenParams)
    {
        $request   = new CreateBookRequest();
        $rules     = $request->rules();
        $validator = Validator::make($givenParams, $rules);
        return $validator;
    }
}