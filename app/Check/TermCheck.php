<?php declare(strict_types = 1);

namespace Pd\Monitoring\Check;

/**
 * @property string $message
 * @property \DateTimeImmutable $term
 */
class TermCheck extends Check
{

	/**
	 * @var \Kdyby\Clock\IDateTimeProvider
	 */
	private $dateTimeProvider;


	public function __construct()
	{
		parent::__construct();
		$this->type = ICheck::TYPE_TERM;
	}


	public function injectDateTimeProvider(\Kdyby\Clock\IDateTimeProvider $dateTimeProvider): void
	{
		$this->dateTimeProvider = $dateTimeProvider;
	}


	public function getTitle(): string
	{
		return 'Upozornění na termín';
	}


	protected function getStatus(): int
	{
		if ($this->dateTimeProvider->getDateTime() > $this->term) {
			return ICheck::STATUS_ERROR;
		} elseif ($this->dateTimeProvider->getDateTime()->add(new \DateInterval('P1W')) > $this->term) {
			return ICheck::STATUS_ALERT;
		} else {
			return ICheck::STATUS_OK;
		}
	}


	public function getterStatus(): int
	{
		return $this->getStatus();
	}


	public function getterStatusMessage(): string
	{
		return '';
	}
}
