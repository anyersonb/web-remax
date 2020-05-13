<?php

namespace Easyanuncios\Modules\Control\Tags;

use Phalcon\Forms\Element;

class ImagenControl extends Element
{
	public function render($attributes = null)
	{


// 		$html = <<<"EOH"
// <div class="file">
// 	<label class="file-label">
// 		<input class="file-input" type="file" name="{$this->getName()}" accept="image/*">
// 		<span class="file-cta">
// 			<span class="file-icon">
// 				<i class="fas fa-upload"></i>
// 			</span>
// 			<span class="file-label">
// 				{$this->getLabel()}
// 			</span>
// 		</span>
// 	</label>
// </div>
// EOH;

		$html = <<<"EOH"
		<input type="file" name="{$this->getName()}" accept="image/*">

EOH;
		return $html;
	}
}
