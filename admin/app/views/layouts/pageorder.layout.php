
<div class = "ui visible right wide sidebar inverted vertical menu" style = "background-color: GRAY; width: 26vw" >
	<div class = "sixteen wide column" >
		<div class = "ui center aligned grid" >
			<div class = "row" style = "margin-top: 8rem" >
				<div class = "thirteen wide left aligned column" >
					<div class = "ui fluid search selection dropdown" >
						<input id = "tableRow" type = "hidden" name = "series" value = "" >
						<i class = "dropdown icon" ></i >
						<div class = "default text" >Select table number</div >

						<div class = "menu" >
							<?php foreach ($datas[0] as $data):?>
							<div class = "item" data-value = "<?php echo $data->id?>" ><?php echo $data->name?></div >
							<?php endforeach;?>
						</div >
					</div >
				</div >
			</div >
			<div class = "row" style = "margin-top: 2rem" >
				<div class = "six wide column" >
					<button class = "ui white button" id = "remove" name = "remove" >
						Remove Manufacturer from Table
					</button >
				</div >
			</div >
			<div class = "row" style = "margin-top: 2rem" >
				<div class = "thirteen wide left aligned column" >
					<div class = "ui fluid search selection dropdown" >
						<input type = "hidden" name = "series" id = "replaceRow" value = "" >
						<i class = "dropdown icon" ></i >
						<div class = "default text" >Select unused manufacturer</div >
						<div class = "menu" >
							<?php foreach ($datas[1] as $data):?>
								<div class = "item" data-value = "<?php echo $data->id?>" ><?php echo $data->name?></div >
							<?php endforeach;?>
						</div >
					</div >
				</div >
			</div >
			<div class = "row" style = "margin-top: 2rem" >
				<div class = "six wide center aligned column" >
					<button class = "ui white button" id = "replace" name = "replace" >
						Replace manufacturer in table
					</button >
				</div >
			</div >
			<div class = "row" style = "margin-top: 2rem" >
				<div class = "six wide center aligned column" >
					<button class = "ui white button" id = "before" >
						Place before manufacturer in table
					</button >
				</div >
			</div >
			<div class = "row" style = "margin-top: 2rem" >
				<div class = "six wide center aligned column" >
					<button class = "ui white button" id = "after" >
						Place after manufacturer in table
					</button >
				</div >
			</div >
		</div >
	</div >
</div >

