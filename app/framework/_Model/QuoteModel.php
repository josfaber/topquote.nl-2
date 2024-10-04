<?php

namespace TopQuote\Model;

use DateTime;

class QuoteModel
{
	protected string $id;

	protected string $import_id;

	protected DateTime $created;

	protected string $slug;

	protected string $quote;

	protected string $sayer;

	protected string $submitter;

	protected array $tags = [];

	protected int $hits;

	protected int $likes;

	protected int $is_private;

	public function __construct(array $db_result)
	{
		$this->setId($db_result['id']);
		$this->setImportId($db_result['import_id']);
		$this->setCreated(new DateTime($db_result['created']));
		$this->setSlug($db_result['slug']);
		$this->setQuote($db_result['quote']);
		$this->setSayer($db_result['sayer']);
		$this->setSubmitter($db_result['submitter']);
		$this->setTags(unserialize($db_result["tags"]));
		$this->setHits($db_result['hits']);
		$this->setLikes($db_result['likes']);
		$this->setIsPrivate($db_result['is_private']);
	}

	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'import_id' => $this->getImportId(),
			'created' => $this->getCreated()->format('Y-m-d H:i:s'),
			'slug' => $this->getSlug(),
			'quote' => $this->getQuote(),
			'sayer' => $this->getSayer(),
			'submitter' => $this->getSubmitter(),
			'tags' => $this->getTags(),
			'hits' => $this->getHits(),
			'likes' => $this->getLikes(),
			'is_private' => $this->getIsPrivate(),
			'sayer_link' => $this->getSayerLink(),
			'submitter_link' => $this->getSubmitterLink(),
			'link' => $this->getLink(),
		];
	}

	public function setId(string $id): void
	{
		$this->id = $id;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function setImportId(string $import_id): void
	{
		$this->import_id = $import_id;
	}

	public function getImportId(): string
	{
		return $this->import_id;
	}

	public function setCreated(DateTime $created): void
	{
		$this->created = $created;
	}

	public function getCreated(): DateTime
	{
		return $this->created;
	}

	public function setSlug(string $slug): void
	{
		$this->slug = $slug;
	}

	public function getSlug(): string
	{
		return $this->slug;
	}

	public function setQuote(string $quote): void
	{
		$this->quote = $quote;
	}

	public function getQuote(): string
	{
		return $this->quote;
	}

	public function setSayer(string $sayer): void
	{
		$this->sayer = $sayer;
	}

	public function getSayer(): string
	{
		return $this->sayer;
	}

	public function setSubmitter(string $submitter): void
	{
		$this->submitter = $submitter;
	}

	public function getSubmitter(): string
	{
		return $this->submitter;
	}

	public function setTags(mixed $tags): QuoteModel
	{
		if (is_bool($tags)) {
			return $this;
		}

		if (is_string($tags)) {
			$this->tags = array_filter(array_map("trim", explode(',', $tags)));
			return $this;
		}

		$this->tags = $tags;
		return $this;
	}

	public function getTags(): array
	{
		return $this->tags;
	}

	public function setHits(int $hits): void
	{
		$this->hits = $hits;
	}

	public function getHits(): int
	{
		return $this->hits;
	}

	public function setLikes(int $likes): void
	{
		$this->likes = $likes;
	}

	public function getLikes(): int
	{
		return $this->likes;
	}

	public function setIsPrivate(int $is_private): void
	{
		$this->is_private = $is_private;
	}

	public function getIsPrivate(): int
	{
		return $this->is_private;
	}

	public function getAgo(bool $full = FALSE): string
	{
		$now = new DateTime;
		$diff = $now->diff($this->created);

		// convert DateInterval $diff to stdCls object 
		$diff = json_decode(json_encode($diff));

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$mapping = array(
			'y' => ['jaar', 'jaar'],
			'm' => ['maand', 'maand'],
			'w' => ['week', 'weken'],
			'd' => ['dag', 'dagen'],
			'h' => ['uur', 'uur'],
			'i' => ['minuut', 'minuten'],
			's' => ['seconde', 'seconden'],
		);
		foreach ($mapping as $key => &$value) {
			// d($key, $diff->$key, $value, isset($diff->$key));
			if (isset($diff->$key) && $diff->$key > 0) {
				$value = $diff->$key . ' ' . ($diff->$key > 1 ? $value[1] : $value[0]);
			} else {
				unset($mapping[$key]);
			}
		}

		if (TRUE !== $full) $mapping = array_slice($mapping, 0, 1);
		return $mapping ? implode(', ', $mapping) . ' geleden' : 'zojuist';
	}

	public function getTagsLinks(): string
	{
		return implode("", array_map(function ($tag) {
			return "<a class=\"tag\" href=\"" . site_url("quotes/tag") . "/" . strtolower(trim($tag)) . "\" title=\"Alle uitspraken met tag {$tag}\">{$tag}</a>";
		}, $this->tags));
	}

	public function getLink(): string
	{
		return site_url("quote") . "/" . $this->slug;
	}

	public function getSayerLink(): string
	{
		return site_url("quotes/sayer") . "/" . $this->sayer;
	}

	public function getSubmitterLink(): string
	{
		return site_url("quotes/submitter") . "/" . $this->submitter;
	}
}
