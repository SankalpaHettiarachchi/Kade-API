<?php

it('has auth\login page', function () {
    $response = $this->get('/auth\login');

    $response->assertStatus(200);
});
