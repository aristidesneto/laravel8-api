<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Tenant
    |--------------------------------------------------------------------------
    |
    | Define o slug do tenant administrador do sistema
    | Esse Tenant tem acesso a todos os outros tenants
    |
    */

    'admin_tenant' => 'master',

    /*
    |--------------------------------------------------------------------------
    | Token Name
    |--------------------------------------------------------------------------
    |
    | Nome do token que será criado para ser utilizado nas requests
    | Token secure - Para ambiente de desenvolvimento deixar como null,
    | em produção com HTTPS deixar como true
    */

    'token_name' => 'auth_token',

    'token_secure' => env('TOKEN_SECURE', null),

];
