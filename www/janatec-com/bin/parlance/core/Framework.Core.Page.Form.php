<?

	class Form 
	{
		 var $NEW = 0;
		 var $POST = 1;
		 var $formid;
		 var $decorator;
		 var $content;
		 var $formstate;

		 function Form()
		 {
			$this->_constructor();
		 }
		 function _constructor()
		 {
			$this->formid = '';
			$this->decorator = '';
			$this->content = '';
			$this->formstate = $this->NEW;
		 }
		 function view()
		 {
		 	echo $this->getContent();
		 }
		 function setFormId($formid)
		 {
			$this->formid= $formid;
		 }
		 function getFormId()
		 {
			return $this->formid;
		 }
		function setDecorator($decorator)
		{
			$this->decorator= $decorator;
		}
		function getDecorator()
		{
			return $this->decorator;
		}
		function setContent($content)
		{
			$this->content = $content;
		}
		function getContent()
		{
			return $this->content;
		}
		function getFormState()
		{
			return ($_REQUEST['formid'] == $this->getFormId())
				 ? $this->POST : $this->NEW;
		}
		function setFormState($formstate)
		{
			$this->formstate = $formstate;
		}
	}

?>