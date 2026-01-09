

<script src="<?php echo base_url('assets/js/aplikasi/timeline.js'); ?>"></script>
<!-- Controller Content -->
<script type="text/javascript">
  $(document).ready(function() {
    var uuid = $('#timeline-config').data('uuid');
    var apiUrl = "<?php echo base_url('user/pelaporan/timeline/'); ?>" + uuid;
    TimelineController(apiUrl);
  });
</script>