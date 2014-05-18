<?php

namespace UserNew\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserNewUserBundle extends Bundle
{
	public function getParent()
	{
    	return 'FOSUserBundle';
	}
}
