<script type="text/javascript" src="/js/loadall.js"></script>
<script type="text/javascript" src="/js/tr.js?1435920624"></script>
<div class="col-sm-12">
       
 <audio >
    <source src="/sounds/bell_ring.ogg?1435920624" type="audio/ogg; codecs=vorbis">
    <source src="/resources/sounds/bell_ring.mp3?1435920624" type="audio/mpeg">
    Тег audio не поддерживается вашим браузером. 
  
  </audio>

    <h3 class="text-center">Здравстуйте, <?=$this->session->userdata('fam')?></h3>

<table id="zayavki_table"  width="100%" class="table table-bordered table-hover table-condensed">
    <thead id="z_thead">
      <tr>
        <th>№ заявки</th>
        <th>Насел.пункт</th>
        <th>Адрес</th>
        <th>Без воды</th>
        <th>Дата поступления</th>
        <th>Тип работ</th>
        <th>Передал, ФИО</th>
        <th>Принял, ФИО</th>
        <th>Инв №</th>
       </tr>
    </thead>
    
</table>
    <?php echo "<p class='pag'>".$this->pagination->create_links()."</p>"; ?>
</div>


