</div><!-- end #content -->
<?php $this->benchmark->mark('code_end');?>		
<div  id="footer" class="clearfix">
	<p class="left">БилетОмск.Ру - Панель управления</p>
		<p class="right">Использование памяти: <?php echo $this->benchmark->memory_usage();?> | Генерация за <?php echo $this->benchmark->elapsed_time('code_start', 'code_end');?></p>
	</div><!-- end #footer -->
</div><!-- end container -->

</body>
</html>