<?php

it('has auth\update page', function () {
    $response = $this->get('/auth\update');

    $response->assertStatus(200);
});
