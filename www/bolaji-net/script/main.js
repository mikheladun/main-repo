var ScrlDivA;var ScrlDivB;var ScrlDivX;var ScrlDivPlA;var ScrlDivPlB;// JavaScript Documentfunction init(){	//ScrollableContent	ScrlDivA = new Fx.Scroll($('ScrlDivA'));	ScrlDivB = new Fx.Scroll($('ScrlDivB'));	ScrlDivX = new Fx.Scroll($('ScrlDivX'));	if($('ScrlDivPlA'))	{		//ScrollableContent Handle		$('ScrlDivPlAHndUp').addEvent('click', function(){ScrlDivPlA.scrollTo($('ScrlDivPlA').getSize()['scroll'].y,$('ScrlDivPlA').getSize()['scroll'].y-$('ScrlDivPlA').getCoordinates().height);});		$('ScrlDivPlAHndDwn').addEvent('click', function(){ScrlDivPlA.scrollTo($('ScrlDivPlA').getSize()['scroll'].y,$('ScrlDivPlA').getSize()['scroll'].y+$('ScrlDivPlA').getCoordinates().height);});	}	if($('ScrlDivPlB'))	{		//ScrollableContent Handle		$('ScrlDivPlBHndUp').addEvent('click', function(){ScrlDivPlB.scrollTo($('ScrlDivPlB').getSize()['scroll'].y,$('ScrlDivPlB').getSize()['scroll'].y-$('ScrlDivPlB').getCoordinates().height);});		$('ScrlDivPlBHndDwn').addEvent('click', function(){ScrlDivPlB.scrollTo($('ScrlDivPlB').getSize()['scroll'].y,$('ScrlDivPlB').getSize()['scroll'].y+$('ScrlDivPlB').getCoordinates().height);});	}	//SrollableContent Handle	if($('ScrlDivA'))	{		$('ScrlDivAHndUp').addEvent('click', function(){ScrlDivA.scrollTo($('ScrlDivA').getSize()['scroll'].y,$('ScrlDivA').getSize()['scroll'].y-$('ScrlDivA').getCoordinates().height);});		$('ScrlDivAHndDwn').addEvent('click', function(){ScrlDivA.scrollTo($('ScrlDivA').getSize()['scroll'].y,$('ScrlDivA').getSize()['scroll'].y+$('ScrlDivA').getCoordinates().height);});	}	if($('ScrlDivB'))	{		$('ScrlDivBHndUp').addEvent('click', function(){ScrlDivB.scrollTo($('ScrlDivB').getSize()['scroll'].y,$('ScrlDivB').getSize()['scroll'].y-$('ScrlDivB').getCoordinates().height);});		$('ScrlDivBHndDwn').addEvent('click', function(){ScrlDivB.scrollTo($('ScrlDivB').getSize()['scroll'].y,$('ScrlDivB').getSize()['scroll'].y+$('ScrlDivB').getCoordinates().height);});	}	if($('ScrlDivX'))	{		$('ScrlDivXHndUp').addEvent('click', function(){ScrlDivX.scrollTo($('ScrlDivX').getSize()['scroll'].y,$('ScrlDivX').getSize()['scroll'].y-$('ScrlDivX').getCoordinates().height);});		$('ScrlDivXHndDwn').addEvent('click', function(){ScrlDivX.scrollTo($('ScrlDivX').getSize()['scroll'].y,$('ScrlDivX').getSize()['scroll'].y+$('ScrlDivX').getCoordinates().height);});	}	//Highlight selection in .RightContentDiv .ContentDiv	$$('.RightContentDiv .ContentDiv Ul Li','.RightContentDiv .ContentDiv Ul Li A','.RightContentDiv .ContentDiv Div','.RightContentDiv .ContentDiv Div A').each(			function(elem) {				elem.addEvent('click',  							  function(){								  $$('.RightContentDiv .ContentDiv Ul Li.Current','.RightContentDiv .ContentDiv Div.Current').each(function(elem){elem.removeClass('Current')});								  elem.addClass('Current');							 }				)}	);	//Highlight selection in #Content .BaseContentDiv	$$('#ScrlDivA Li','#ScrlDivA Li A').each(			function(elem) {				elem.addEvent('click',  							  function(){								  $$('#ScrlDivA Li.Current').each(function(elem){elem.removeClass('Current')});								  $$('#ScrlDivA Li A.Current').each(function(elem){elem.removeClass('Current')});								  elem.addClass('Current');								  $('ChgDivB').effects().start({'opacity':[0,1]});								  $$('#ScrlDivB Li','#ScrlDivB Li A').each(function(elem){elem.removeClass('Current')}); 								  $('ChgDivX').setOpacity(0);							 }				)}	);	//Highlight selection in #Content .BaseContentDiv	$$('#ScrlDivB Li','#ScrlDivB Li A').each(			function(elem) {				elem.addEvent('click',  							  function(){								  $$('#ScrlDivB Li.Current').each(function(elem){elem.removeClass('Current')});								  $$('#ScrlDivB Li A.Current').each(function(elem){elem.removeClass('Current')});								  elem.addClass('Current');								  $('ChgDivX').effects().start({'opacity':[0,1]});							 }				)}	);	//Highlight selection in .RightContentDiv .SectionHeader	$$('.RightContentDiv .SectionHeader Ul Li A').each(			function(elem) {				elem.addEvent('click',  							  function(){								  $$('.RightContentDiv .SectionHeader Ul Li.Current').each(function(elem){elem.removeClass('Current')});								  elem.getParent().addClass('Current');								  $$('.RightContentDiv .ContentDiv Ul').each(function(elem){elem.addClass('Invisible');});								  $(elem.getProperty('name')).removeClass('Invisible');							 }				)}	);	if($('MPlayer_RR'))	{		$('MPlayer_RR').addEvent('click', function(){			$$('#ScrlDivPlA .Current').each(				function(elem){					if(elem.getPrevious()){						var prev = elem.getPrevious().getChildren().getLast();						self.location = prev.getChildren()[0];					}				})		});	}	if($('MPlayer_FF'))	{		$('MPlayer_FF').addEvent('click', function(){			$$('#ScrlDivPlA .Current').each(				function(elem){					if(elem.getNext())					{						var next = elem.getNext().getChildren().getLast();						self.location= next.getChildren()[0];					}				})		});	}	//$$('iframe').each(function(elem){elem.setStyles({visibility:'hidden',display:'none'})});}window.addEvent('domready', init) ;function Csw(id,c,w){if($(id)){ $(id).addClass($(id).hasClass(c)?w:($(id).hasClass(w)?c:c)); }}function Css(id,c){if($(id)){$(id).setProperty('class',c)}};