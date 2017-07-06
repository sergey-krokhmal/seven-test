<div class="row">
    <div class="col-md-6">
        <div class="panel-part panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Исходные данные</h3>
            </div>
            <div class="panel-body">
                <h4 class="h5"><?=$input_data_name?></h4>
                <pre><?print_r($input_data)?></pre>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-part panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Результат</h3>
            </div>
            <div class="panel-body">
                <?if (count($result) == 2):?>
                    <?foreach ($result as $res):?>
                        <div class="col-md-6">
                            <h4 class="h5"><?=$res['name']?></h4>
                            <pre><?print_r($res['array'])?></pre>
                        </div>
                    <?endforeach?>
                <?else:?>
                    <h4 class="h5"><?=$result[0]['name']?></h4>
                    <pre><?print_r($result[0]['array'])?></pre>
                <?endif?>
                
            </div>
        </div>
    </div>
</div>