<?php $this->load->view('includes/header') ?>
<?php $this->load->view('includes/sidebar') ?>

<title>TWC Dashboard</title>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
    <div class="row">
            <div class="col-12 mt-1">
                <div class="card bg-dark">
                    <img src="<?= base_url('assets/images/twc-banner.svg'); ?>" alt="Logo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="card text-center">
            <div class="card-header bg-success text-white">
              <h3 class="card-title">Divine Word College of Calapan (VMGC)</h3>
            </div>
            <div class="card-body">
              <h4><strong>Vision</strong></h4>
              <p>A globally competitive institution, faithful to the teachings and tradition of the Catholic Church working together towards the development of the persons following the examples of St. Arnold Janssen and St. Joseph Freinademetz.</p>

              <h4><strong>Mission</strong></h4>
              <p>To develop and enhance the capabilities to become witnesses to the Word and responsive to the demands of society.</p>

              <h4><strong>Goals</strong></h4>
              <ul class="list-unstyled">
                <li>Global Competence</li>
                <li>Cultural Preservation</li>
                <li>Academic Excellence</li>
                <li>SVD Spirituality</li>
              </ul>

              <h4><strong>Core Values</strong></h4>
              <ul class="list-unstyled">
                <li><strong>I</strong> - Integrity</li>
                <li><strong>S</strong> - Social Responsibility</li>
                <li><strong>E</strong> - Excellence</li>
                <li><strong>E</strong> - Evangelization</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="row">
            <?php if (!empty($assigned_programs)) : ?>
              <?php foreach ($assigned_programs as $program) : ?>
                <div class="col-md-12 mb-3">
                  <div class="card">
                    <div class="card-header bg-info text-white">
                      <h4 class="card-title"><?= $program->scholarship_program ?></h4>
                    </div>
                    <div class="card-body">
                      <p><strong>Type:</strong> <?= $program->scholarship_type ?></p>
                      <p><strong>Academic Year:</strong> <?= $program->academic_year ?></p>
                      <p><strong>Semester:</strong> <?= $program->semester ?></p>
                      <p><strong>Percentage:</strong></p>
                      <ul>
                        <?php
                        $percentages = explode(';', $program->percentage);
                        foreach ($percentages as $percentage):
                        ?>
                          <li><?= trim($percentage) ?>%</li>
                        <?php endforeach; ?>
                      </ul>
                      <p><strong>Description:</strong> <?= $program->description ?></p>
                      <p><strong>Qualifications:</strong></p>
                      <ul>
                        <?php
                        $qualifications = explode(';', $program->qualifications);
                        foreach ($qualifications as $qualification):
                        ?>
                          <li><?= trim($qualification) ?></li>
                        <?php endforeach; ?>
                      </ul>
                      <p><strong>Requirements:</strong></p>
                      <ul>
                        <?php
                        $requirements = explode(';', $program->requirements);
                        foreach ($requirements as $requirement):
                        ?>
                          <li><?= trim($requirement) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="col-md-12">
                <div class="alert alert-warning">
                  No assigned scholarship programs found.
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('includes/footer') ?>