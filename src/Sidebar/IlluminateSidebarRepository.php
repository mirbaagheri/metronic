<?php
namespace Mirbaagheri\MirMetronic\Sidebar;

class IlluminateSidebarRepository implements SidebarRepositoryInterface
{
	public $Search				= true;
	public $data_auto_speed		= 200;
	public $data_keep_expanded	= true;
	public $data_auto_scroll	= true;
	public $Activate			= "Dashboard";
	public $items				= NULL;
	public $SearchHtml;

	public function __construct()
		{
		}

	// Disable OR Enable Search Area
	public function search($value)
	{
		$this->Search = $value;
	}


	public function Toggler($value)
	{
		$this->Toggler = $value;
	}

	public function Config($Config)
	{
		foreach($Config as $key=>$value)
		{
			$this->$key = $value;
		}
		// DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
		// DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		// DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		// DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		// DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		// DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		// DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	}

	public function Activate($name)
	{
		$this->Activate = $name;
	}

	// Load sidebar items from DB
	public function Load($obj)
	{
        $this->items    = null;
	    $SubItems       = null;
		foreach(json_decode($obj) as $item => $content)
		{
			if(isset($content->items) && is_object ($content->items))
			{
				if(array_key_exists($this->Activate,$content->items))$class="active open";
				else $class='';

				foreach($content->items as $sub_item=>$sub_content)
				{
					if($this->Activate == $sub_item) $SubClass='class="nav-item active"';
					else $SubClass='class="nav-item"';

					$SubItems .= '<li '.$SubClass.'>
									<a href="?l='.$sub_item.'" class="nav-link">
										<i class="'.$sub_content->icon.'"></i>
										<span class="title">'.$sub_content->text.'</span>
									</a>
								</li>';
						}
                $this->items.='<li class="nav-item '.$class.'">
					<a href="javascript:;" class="nav-link nav-toggle">
					<i class="'.$content->icon.'"></i>
					<span class="title">'.$content->text.'</span>
					<span class="arrow '.$class.'"></span>
					</a>
					<ul class="sub-menu">
						'.$SubItems.'
					</ul>
				</li>';

				}
				else
				{
					if($this->Activate==$item) $class='class="active"';
					else $class='';

					$this->items.='<li '.$class.'>
						<a href="'.$item.'">
						<i class="'.$content->icon.'"></i>'.trans('mirMetronic.'.$item.'').'</a>
					</li>';
					?>

                    <?php
				}
			}
	}


	private function SearchHtml()
	{
	 if($this->Search)
	 	return '<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search  " action="page_general_search_3.html" method="POST">
						<a href="javascript:;" class="remove">
							<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<a href="javascript:;" class="btn submit">
									<i class="icon-magnifier"></i>
								</a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>';
	}

	public function Render()
	{
		if($this->data_keep_expanded) $this->data_keep_expanded = "true";
		if($this->data_auto_scroll) $this->data_auto_scroll = "true";

		echo '<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<!-- BEGIN SIDEBAR -->
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		
		<ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="'.$this->data_keep_expanded.'" data-auto-scroll="'.$this->data_auto_scroll.'" data-slide-speed="'.$this->data_auto_speed.'" style="padding-top: 20px">
                           '.$this->SearchHtml().'
                           '.$this->items.'
                            
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->';
	}
}
?>