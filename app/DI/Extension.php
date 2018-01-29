<?php declare(strict_types = 1);

namespace Pd\Monitoring\DI;

class Extension extends \Nette\DI\CompilerExtension
{

	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$userStorageDefinitionName = $builder->getByType(\Nette\Security\IUserStorage::class) ?: 'nette.userStorage';
		$builder
			->getDefinition($userStorageDefinitionName)
			->setFactory(\Pd\Monitoring\User\UserStorage::class)
		;
	}

}
