<?php

declare(strict_types=1);

namespace MasterRO\Flash\Tests;

use Flash;
use MasterRO\Flash\FlashFacade;
use Orchestra\Testbench\TestCase;

class FlashTest extends TestCase
{
    protected function getPackageAliases($app)
    {
        return [
            'Flash' => FlashFacade::class,
        ];
    }

    /** @test */
    public function it_puts_message_to_session()
    {
        flash('Test');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Test', $sessionMessage['message']);
        $this->assertEquals('success', $sessionMessage['type']);
    }

    /** @test */
    public function it_puts_success_message_to_session()
    {
        flash('Success message', 'success');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Success message', $sessionMessage['message']);
        $this->assertEquals('success', $sessionMessage['type']);

        session()->flush();

        flash()->success('Success message 2');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Success message 2', $sessionMessage['message']);
        $this->assertEquals('success', $sessionMessage['type']);

        session()->flush();

        Flash::success('Success message 3');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Success message 3', $sessionMessage['message']);
        $this->assertEquals('success', $sessionMessage['type']);
    }

    /** @test */
    public function it_puts_error_message_to_session()
    {
        flash('Error message', 'error');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Error message', $sessionMessage['message']);
        $this->assertEquals('error', $sessionMessage['type']);

        session()->flush();

        flash()->error('Error message 2');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Error message 2', $sessionMessage['message']);
        $this->assertEquals('error', $sessionMessage['type']);

        session()->flush();

        Flash::error('Error message 3');

        [$sessionMessage] = session('flash_messages', [null]);

        $this->assertEquals('Error message 3', $sessionMessage['message']);
        $this->assertEquals('error', $sessionMessage['type']);
    }

    public function it_puts_multiple_flash_messages()
    {
        flash('Error message', 'error');
        flash('Success message');
        flash()->info('Info message');
        Flash::warning('Warning message');

        $tests = [
            ['Error message', 'error'],
            ['Success message', 'success'],
            ['Info message', 'info'],
            ['Warning message', 'warning'],
        ];

        foreach ($tests as $key => $test) {
            $sessionMessage = session('flash_messages', [])[$key] ?? null;

            $this->assertEquals($test[0], $sessionMessage['message']);
            $this->assertEquals($test[1], $sessionMessage['type']);
        }
    }
}
