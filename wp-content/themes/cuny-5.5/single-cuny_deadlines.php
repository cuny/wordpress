<?php get_header(); ?>

<section class="wpb_row vc_row-fluid smartphone-hide">
    <div class="wpb_column vc_col-sm-12 column_container">
        <div class="wpb_wrapper">
             <div class="menu-breadcrumbs-posts-container">
                <ul id="menu-breadcrumbs-posts" class="breadcrumbs inline">
                    <li><a href="<?php echo get_option('home'); ?>">Home</a></li>
                    <li><a href="<?php echo get_option('home'); ?>/admissions">Admissions</a></li>
                    <li><a href="<?php echo get_option('home'); ?>/admissions/graduate-admissions">Graduate Admissions</a></li>
                    <li><a href="<?php echo get_option('home'); ?>/admissions/graduate-admissions/deadlines">Graduate Admissions Deadlines</a></li>
                    <li class="last"><?php echo get_the_title(); ?></li>
                </ul>
            </div>                                   
        </div>
    </div>
</section>

<div class="wpb_row vc_row vc_row-fluid">
    <div class="vc_col-sm-12 wpb_column column_container">
        <div class="wpb_wrapper">
            <div class="wpb_row vc_row-fluid promo">
                <h1 class="section-title"><?php the_post(); the_title() ?></h1>
            </div> 
        </div>
    </div>
</div>

<div class="wpb_row vc_row vc_row-fluid">
    <div class="vc_col-sm-12 wpb_column column_container">
        <div class="wpb_wrapper">
            <div class="vc_col-sm-3 wpb_column column_container">
                <div class="wpb_wrapper">
                    <div class="wpb_row vc_row-fluid promo">
                        <?php $program_type = get_field( 'program_type', $GLOBALS['post']->ID ); 
                        if ( !empty( $program_type ) ) : ?>
                        <h3>Program Type</h3>
                        <p>
                            <?php echo $program_type; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $report_college = get_field( 'report_college', $GLOBALS['post']->ID ); 
                        if ( !empty( $report_college ) ) : ?>
                        <h3>Report College</h3>
                        <p>
                            <?php echo $report_college; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $enrollment_college = get_field( 'enrollment_college', $GLOBALS['post']->ID ); 
                        if ( !empty( $enrollment_college ) ) : ?>
                        <h3>Enrollment College</h3>
                        <p>
                            <?php echo $enrollment_college; ?>
                        </p>
                        <p>&#160;</p>
                        <?php endif; ?>

                    </div> 
                </div>
            </div>
            <div class="vc_col-sm-3 wpb_column column_container">
                <div class="wpb_wrapper">
                    <div class="wpb_row vc_row-fluid promo">
                        <?php $nysed_program_code = get_field( 'nysed_program_code', $GLOBALS['post']->ID ); 
                        if ( !empty( $nysed_program_code ) ) : ?>
                        <h3>NYSED Program Code</h3>
                        <p>
                            <?php echo $nysed_program_code; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $graduate_program_degree = get_field( 'graduate_program_degree', $GLOBALS['post']->ID ); 
                        if ( !empty( $graduate_program_degree ) ) : ?>
                        <h3>Graduate Program Degree</h3>
                        <p>
                            <?php echo $graduate_program_degree; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $certificate_advance_study = get_field( 'certificate_advance_study', $GLOBALS['post']->ID ); 
                        if ( !empty( $certificate_advance_study ) ) : ?>
                        <h3>Certificate of Advance Study</h3>
                        <p>
                            <?php echo $certificate_advance_study; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $dual = get_field( 'dual', $GLOBALS['post']->ID ); 
                        if ( !empty( $dual ) ) : ?>
                        <h3>Dual</h3>
                        <p>
                            <?php echo $dual; ?>
                        </p>
                        <p>&#160;</p>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>
                        <?php endif; ?>

                        <?php $dual_individual_master = get_field( 'dual_individual_master', $GLOBALS['post']->ID ); 
                        if ( !empty( $dual_individual_master ) ) : ?>
                        <h3>Dual &amp; Individual Master</h3>
                        <p>
                            <?php echo $dual_individual_master; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="vc_col-sm-3 wpb_column column_container">
                <div class="wpb_wrapper">
                    <div class="wpb_row vc_row-fluid promo">
                        <h3>Deadline</h3>
                        <ul>
                        <?php $deadline = get_field( 'deadline', $GLOBALS['post']->ID );
                        foreach($deadline as $a_deadline){
                            echo "<li><strong>{$a_deadline["deadline_type"]}</strong><br />
                            {$a_deadline["deadline_date"]}</li>";
                        }
                        ?>
                        </ul>            
                    </div>
                </div>
            </div>
            <div class="vc_col-sm-3 wpb_column column_container">
                <div class="wpb_wrapper">
                    <div class="wpb_row vc_row-fluid promo">
                        <h3>Link</h3>
                        <ul>
                        <?php $link = get_field( 'link', $GLOBALS['post']->ID );
                        foreach($link as $a_link){
                            echo "<li><a href='{$a_link["link_url"]}'>{$a_link["link_description"]}</a></li>";
                        }
                        ?>
                        </ul>
                        <div class="vc_separator wpb_content_element vc_el_width_100 vc_sep_double">
                            <span class="vc_sep_holder vc_sep_holder_l">
                                <span class="vc_sep_line"></span>
                            </span>
                            <span class="vc_sep_holder vc_sep_holder_r">
                                <span class="vc_sep_line"></span>
                            </span>
                        </div>

                        <?php $notes = get_field( 'notes', $GLOBALS['post']->ID ); 
                        if ( !empty( $notes ) ) : ?>
                        <h3>Notes</h3>
                        <p>
                            <?php echo $notes; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>