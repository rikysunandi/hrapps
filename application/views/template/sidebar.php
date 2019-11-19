<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/img/pln.png'); ?>" class="img-square" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p></p>
                <p></p>
				<p>PLN FIT</p>
                <p></p>
            </div>
        </div>

        <!-- search form -->                    
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header bg-light-active">MENU</li>     
                <?php
				$user_id=$this->session->userdata('user_id');
                if ($this->ion_auth->is_admin()) {
                    $main = $this->db->query("select id_menu,nama_menu,icon,link,parent,role,aktif from tb_menu
					where aktif='Y' and id_menu in (select menu_id from tb_users_menu where group_id = (select group_id from
					tb_users_groups where user_id='$user_id'))");
					
                    foreach ($main->result() as $m) {
                        // chek ada submenu atau tidak
                        $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu, 'aktif' => 'Y'));
                        if ($sub->num_rows() > 0) {
                            // buat menu + sub menu
                            $uri = $this->uri->segment(1);
                            $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();
                            if ($m->id_menu == $idclass['parent']) {
                                $class = "active treeview";
                            } else {
                                $class = "";
                            }
                            echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
                            <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
                            <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
                            echo "<ul class='treeview-menu'>";
                            foreach ($sub->result() as $s) {
                                $uri = $this->uri->segment(1);
                                if ($s->link == $uri) {
                                    $class1 = "active treeview";
                                } else {
                                    $class1 = "";
                                }
                                echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
                            }
                            echo "</ul>";
                            echo '</li>';
                        } else {
                            // single menu
                            $uri = $this->uri->segment(1);
                            if ($m->link == $uri) {
                                $class2 = "active";
                            } else {
                                $class2 = "";
                            }
                            echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
                            </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
                        }
                    }
                    echo '<li class="header bg-yellow-active">ADMIN MENU</li> ';
                    $admin = $this->db->get_where('tb_menu', array('parent' => 0, 'role' => 'Administrator'));
                    foreach ($admin->result() as $m) {
                        // chek ada submenu atau tidak
                        $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu));
                        if ($sub->num_rows() > 0) {
                            // buat menu + sub menu
                            $uri = $this->uri->segment(1);
                            $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();
                            if ($m->id_menu == $idclass['parent']) {
                                $class = "active treeview";
                            } else {
                                $class = "";
                            }
                            echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
                                <span class="treeview">' . strtoupper($m->nama_menu) . '</span>
                                <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
                            echo "<ul class='treeview-menu'>";
                            foreach ($sub->result() as $s) {
                                $uri = $this->uri->segment(1);
                                if ($s->link == $uri) {
                                    $class1 = "active treeview";
                                } else {
                                    $class1 = "";
                                }
                                echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
                            }
                            echo "</ul>";
                            echo '</li>';
                        } else {
                            // single menu
                            $uri = $this->uri->segment(1);
                            if ($m->link == $uri) {
                                $class2 = "active";
                            } else {
                                $class2 = "";
                            }
                            echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
                                </i>  <span class="treeview">' . strtoupper($m->nama_menu) . '</span>') . '</li>';
                        }
                    }
                } else {
                    $main = $this->db->query("select id_menu,nama_menu,icon,link,parent,role,aktif from tb_menu
					where aktif='Y' and id_menu in (select menu_id from tb_users_menu where group_id = (select group_id from
					tb_users_groups where user_id='$user_id'))");
                    foreach ($main->result() as $m) {
                        // chek ada submenu atau tidak
                        $sub = $this->db->get_where('tb_menu', array('parent' => $m->id_menu, 'aktif' => 'Y'));
                        if ($sub->num_rows() > 0) {
                            // buat menu + sub menu
                            $uri = $this->uri->segment(1);
                            $idclass = $this->db->get_where('tb_menu', array('link' => $uri))->row_array();
                            if ($m->id_menu == $idclass['parent']) {
                                $class = "active treeview";
                            } else {
                                $class = "";
                            }
                            echo '<li class=' . $class . '>' . anchor($m->link, '<i class="' . $m->icon . '"></i>
                            <span>' . strtoupper($m->nama_menu) . '</span>
                            <b class="fa fa-angle-left pull-right"></b>', array('class' => 'dropdown-toggle'));
                            echo "<ul class='treeview-menu'>";
                            foreach ($sub->result() as $s) {
                                $uri = $this->uri->segment(1);
                                if ($s->link == $uri) {
                                    $class1 = "active treeview";
                                } else {
                                    $class1 = "";
                                }
                                echo '<li class=' . $class1 . '>' . anchor($s->link, '<i class="' . $s->icon . '"></i>' . strtoupper($s->nama_menu)) . '</li>';
                            }
                            echo "</ul>";
                            echo '</li>';
                        } else {
                            $uri = $this->uri->segment(1);
                            if ($m->link == $uri) {
                                $class2 = "active";
                            } else {
                                $class2 = "";
                            }
                            echo '<li class=' . $class2 . '>' . anchor($m->link, '<i class="' . $m->icon . ' fa-lg">
                            </i>  <span>' . strtoupper($m->nama_menu) . '</span>') . '</li>';
                        }
                    }
                }
                ?>

        </ul><!--/.nav-list-->             
    </section>
    <!-- /.sidebar -->
</aside>
