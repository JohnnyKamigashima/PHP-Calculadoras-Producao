<?php
$str = "string(763) '
<table cellspacing='0' cellpadding='0'>
    <tbody>
        <tr>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>A</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>B</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>C</p>
            </td>
        </tr>
        <tr>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>A1</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>2</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>3</p>
            </td>
        </tr>
        <tr>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>A2</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>5</p>
            </td>
            <td style='width: 89px; height: 11px;' valign='top'>
                <p>6</p>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>";

// echo "<pre>";
// echo ($str);
echo removeTags($str);
// echo "</pre>";

function removeTags($str)
{
    if (($str === null) || ($str === ''))  return false;
    // Regular expression to identify HTML tags in
    // the input string. Replacing the identified
    // HTML tag with a null string.
    /**  $cleantext = preg_replace('/((<td.*?>\n +<p>(\n +)?)|((\n +)?<\/p>\n +<\/td>\n +))/i', ' ', $str); */
    $cleantext = preg_replace('/((\n +)?<td.*?>(\n +)?<p>(\n +)?|((\n +)?<\/p>( +)?(\n +)?<\/td>(\n +)?))/i', ' ', $str);
    // $cleantext = preg_replace('/((\n +)?<\/p>( +)?(\n +)?<\/td>(\n +)?)/i', ' ', $cleantext);

    return $cleantext;
    $cleantext = preg_replace('/(<(\/?(p|div|h|a|style|span|code|table|tr|tbody).*?)>)/i', '<br>', $cleantext);
    $cleantext = preg_replace('/( ?\&nbsp;|\n|\r)+/i', ' ', $cleantext);
    $cleantext = preg_replace('/(( ?(\n)?<br ?\/?> ?)+)/mi', "<br>", $cleantext);
}