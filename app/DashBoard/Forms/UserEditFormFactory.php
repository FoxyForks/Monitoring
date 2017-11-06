<?php declare(strict_types = 1);

namespace Pd\Monitoring\DashBoard\Forms;

class UserEditFormFactory
{

	public const FIELD_GIT_HUB_NAME = 'gitHubName';
	public const FIELD_ADMINISTRATOR = 'administrator';
	public const FIELD_SLACK_ID = 'slackId';

	/**
	 * @var Factory
	 */
	private $factory;

	/**
	 * @var \Nette\Security\User
	 */
	private $user;


	public function __construct(
		Factory $factory,
		\Nette\Security\User $user
	) {
		$this->factory = $factory;
		$this->user = $user;
	}


	public function create()
	{
		$form = $this->factory->create();

		$form->addText(self::FIELD_GIT_HUB_NAME, 'Jméno');
		$form
			->addText(self::FIELD_SLACK_ID, 'Slack ID')
			->setNullable(TRUE)
		;

		if ($this->user->isAllowed('user', 'edit')) {
			$form->addCheckbox(self::FIELD_ADMINISTRATOR, 'Administrátor');
		}

		$form->addSubmit('save', 'Uložit');

		return $form;
	}

}
