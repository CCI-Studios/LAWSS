
<?php 

function lawss_form_alter(&$form, &$form_state, $form_id )
{	
	if($form_id == 'search_block_form')
	{	
		$form['search_block_form']['#attributes']['placeholder'] = t('Search');
	}
}

function lawss_views_pre_render($view) {
  if ($view->name == 'reports') {

    if ($view->current_display == 'page') {

    	if(empty($view->result))
    	{
	      $view->set_title($view->args[0]);
    	}
      }
    }

	  if ($view->current_display == 'page_1')
	  {
	  		$view->set_title($view->args[0]." Archive");
	  }
  }