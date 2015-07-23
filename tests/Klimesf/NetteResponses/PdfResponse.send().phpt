<?php


use Nette\Http;

require __DIR__ . '/../bootstrap.php';

test(function () {
	$response = new \Klimesf\NetteResponses\PdfResponse(__DIR__ . '/../pdf.pdf');
	$response->send(new Http\Request(new \Nette\Http\UrlScript()), $httpResponse = new Http\Response());
	Assert::same('application/pdf', $httpResponse->getHeader('Content-type'));
});