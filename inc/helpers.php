<?php

/**
 * Include SVG
 */
function get_svg($filename, $path = false, $title = '')
{
  if ($path) {
    $path = get_template_directory() . $path;
  } else {
    $path = get_template_directory() . '/assets/icons/' . $filename . '.svg';
  }

  $arrContextOptions = array(
    "ssl" => array(
      "verify_peer" => false,
      "verify_peer_name" => false,
    ),
  );

  if ($svg = @file_get_contents($path, false, stream_context_create($arrContextOptions))) {
    $dom = new DOMDocument();
    $dom->loadXML($svg);
    $items = $dom->getElementsByTagName("svg");
    $titleTag = $items[0]->getElementsByTagName('title');
    if ($title) {
      // set title of svg
      if ($titleTag->length > 0) {
        // replace current title
        $titleTag->item(0)->nodeValue = $title;
      } else {
        // add title tag
        $titleTag = $dom->createElement('title', $title);
        $items->item(0)->appendChild($titleTag);
      }
    }
    if ($items->length) {
      $doc = new DOMDocument();
      $doc->appendChild($doc->importNode($items->item(0), true));
      $svg = $doc->saveHTML();
    }
  }
  return $svg;
}

function the_svg($filename, $path = false, $title = '')
{
  if ($svg = get_svg($filename, $path, $title)) {
    echo $svg;
  }
}
