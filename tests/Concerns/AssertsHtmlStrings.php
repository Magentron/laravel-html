<?php

namespace Spatie\Html\Test\Concerns;

use DOMDocument;

trait AssertsHtmlStrings
{
	/**
	 * @param string $expectedHtml
	 * @param string $actualHtml
	 */
    protected function assertHtmlStringEqualsHtmlString($expectedHtml, $actualHtml)
    {
        $this->assertEquals(
            $this->convertToDomDocument($expectedHtml),
            $this->convertToDomDocument($actualHtml),
            '',
            0.0,
            10,
            true
        );
    }

    /**
	 * @param string $html
	 *
     * @return DOMDocument
     */
    protected function convertToDomDocument($html)
    {
        $html = preg_replace('/>\s+</', '><', $html);

        $domDocument = new DOMDocument();
        $domDocument->loadHTML($html);
        $domDocument->preserveWhiteSpace = false;

        return $domDocument;
    }
}
