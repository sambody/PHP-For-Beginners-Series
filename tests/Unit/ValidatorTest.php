<?php

use Core\Validator;

it('validates a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();        // separate
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

it('validates a string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foobar'))->toBeFalse()
        ->and(Validator::email('foobar@example.com'))->toBeTrue();      // chained
});

it('validates that a number is greater than a given amount', function () {
    expect(Validator::greaterThan(10, 1))->toBeTrue()
        ->and(Validator::greaterThan(10, 100))->toBeFalse();
})->only();
