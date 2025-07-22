<?php
    namespace LFWidgets;
    use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;
    class Animations{
        
        public function render_underline_top( $display_menu_id, $lf_alignment): void{
            echo '<style>
            nav.lf-bg-color > ul > li > a {
    position: relative;
}

nav.lf-bg-color > ul > li > a::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; 
    background-color: #808080;
    z-index: 1;
}

nav.lf-bg-color .navbar-nav > li > a.nav-link {
    position: relative;
    height: 40px;
    padding: 0px;
    display: flex;
    align-items: center;
    justify-content: center;
}

nav.lf-bg-color .navbar-nav > li > a.nav-link::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 0%;
    height: 2px; 
    background-color: #ff0000;
    z-index: 1;
    transition: width 0.3s ease; 
}
nav.lf-bg-color .navbar-nav > li > a.nav-link:hover::before{
  width: 100%;
}

@media (max-width: 991px) {
  nav.lf-bg-color .navbar-nav > li > a.nav-link::before {
    display: none;
  }
}
            </style>';
            echo wp_nav_menu([
                        'menu' => $display_menu_id,
                        'menu_class' => 'navbar-nav ' . $lf_alignment,
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'navbarNavDropdown',
                        'walker' => new Custom_Nav_Walker(), // adjust class name if needed
                        'fallback_cb' => 'wp_page_menu'
                    ]);
        }
        public function render_underline_below( $display_menu_id, $lf_alignment): void{
            echo '<style>
            nav.lf-bg-color > ul > li > a {
    position: relative;
}

nav.lf-bg-color > ul > li > a::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* or a specific height, e.g. 3px */
    background-color: #808080;
    z-index: 1;
}

nav.lf-bg-color .navbar-nav > li > a.nav-link {
    position: relative;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0px;
}

nav.lf-bg-color .navbar-nav > li > a.nav-link::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0%;
    height: 2px; /* or a specific height, e.g. 3px for underline */
    background-color: #ff0000;
    z-index: 1;
    transition: width 0.3s ease; /* smoother transition */
}
nav.lf-bg-color .navbar-nav > li > a.nav-link:hover::before{
  width: 100%;
}

@media (max-width: 991px) {
  nav.lf-bg-color .navbar-nav > li > a.nav-link::before {
    display: none;
  }
}
            </style>';
            echo wp_nav_menu([
                        'menu' => $display_menu_id,
                        'menu_class' => 'navbar-nav ' . $lf_alignment,
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'navbarNavDropdown',
                        'walker' => new Custom_Nav_Walker(), // adjust class name if needed
                        'fallback_cb' => 'wp_page_menu'
                    ]);
        }

        public function render_default( $display_menu_id, $lf_alignment): void{
            echo wp_nav_menu([
                        'menu' => $display_menu_id,
                        'menu_class' => 'navbar-nav ' . $lf_alignment,
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'navbarNavDropdown',
                        'walker' => new Custom_Nav_Walker(), // adjust class name if needed
                        'fallback_cb' => 'wp_page_menu'
                    ]);
        }
    }
    
?>