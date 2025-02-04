<?php

namespace Adev\Service;

class Logger
{
	public const BASE_DIR = "/local/logs/adev/";
	public const TIME_ZONE = "GMT+10";

	public static function toFile(string $dirName, $data = null, string $mark = 'no-mark'): void
	{
		$header = self::header($mark);
		$body = print_r($data, true);
		$footer = self::footer($data);

		$log = $header . $body . $footer;

		file_put_contents(self::getLogPath($dirName), $log, FILE_APPEND | LOCK_EX);
	}

	private static function header($mark): string
	{
		$currentDateTime = new \DateTime('now', new \DateTimeZone(self::TIME_ZONE));

		$traceLog = self::getTraceLog();

		$header = "\n" . "==== " . $mark . " ====" . "\n";
		$header .= "KHV: " . $currentDateTime->format("H:i:s d.m.Y") . "\n";
		$header .= $traceLog;
		$header .= "\n" . "˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅˅" . "\n";

		return $header;
	}

	private static function footer($data): string
	{
		$footer = "˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄˄" . "\n\n";
		$needDopLine = in_array(gettype($data), ["integer", "string"]);
		if ($needDopLine) {
			$footer = "\n" . $footer;
		}

		return $footer;
	}

	private static function getLogPath($dirName): string
	{
		$dirPath = self::getFullPathBaseDir() . $dirName;

		self::createDir($dirPath);

		$currentDateTime = new \DateTime('now', new \DateTimeZone(self::TIME_ZONE));

		$name = $currentDateTime->format("Y-m-d") . ".log";

		return $dirPath . "/" . $name;
	}

	private static function createDir($dirPath): void
	{
		if (!is_dir($dirPath)) {
			mkdir($dirPath, 0700, true);
		}

		$locFile = self::getFullPathBaseDir() . "../" . ".htaccess";
		if (!file_exists($locFile)) {
			file_put_contents($locFile, "Order Deny,Allow" . "\n" . "Deny from all");
		}
	}

	private static function getFullPathBaseDir(): string
	{
		$documentRoot = $_SERVER["DOCUMENT_ROOT"];
		return $documentRoot . self::BASE_DIR;
	}

	private static function getTraceLog(): string
	{
		$trace = debug_backtrace(1, 3);
		return $trace[2]['file'] . ":" . $trace[2]['line'];
	}
}