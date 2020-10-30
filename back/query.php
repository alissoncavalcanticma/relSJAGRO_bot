<?php
    $sql = "SELECT 
                TMOV.NUMEROMOV, 
                TPRODUTO.DESCRICAO,
                TITMMOVHISTORICO.HISTORICOLONGO,
                TMOV.STATUS,
                TMOV.HORULTIMAALTERACAO
            FROM TMOV 
            INNER JOIN 
                TITMMOV 
                    ON TMOV.IDMOV = TITMMOV.IDMOV 
                    AND TMOV.CODCOLIGADA = TITMMOV.CODCOLIGADA 
            INNER JOIN
                TPRODUTO
                    ON TITMMOV.IDPRD = TPRODUTO.IDPRD
            INNER JOIN
                TITMMOVHISTORICO
                    ON TITMMOV.CODCOLIGADA = TITMMOVHISTORICO.CODCOLIGADA
                    AND TITMMOV.IDMOV = TITMMOVHISTORICO.IDMOV
                    AND TITMMOV.NSEQITMMOV = TITMMOVHISTORICO.NSEQITMMOV
            WHERE 
                CODTMV = '1.1.01' 
                    AND 
                CODVEN2 = '11.003'
            ORDER BY TMOV.DATAEMISSAO DESC";
    $sql = $pdo->prepare($sql);
    $sql->execute();

    $array = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <table border="1">
        <th>
        NUMEROMOV
        </th>
        <th>
        DESCRICAO
        </th>
        <th>
        HISTÓRICO LONGO
        </th>
        <th>
        STATUS
        </th>
        <th>
        ULTIMA ALTERACAO
        </th>
    <?php
    //print_r($array);die;
    foreach($array as $lista):
    ?>
            <tr style="display: table-row;">
                <td><?= $lista['NUMEROMOV'] ?></td>
                <td><?= $lista['DESCRICAO'] ?></td>
                <td><?= substr($lista['HISTORICOLONGO'], 0, 25); ?></td>
                <td><?= $lista['STATUS'] == 'A' ? 'Pendente' : 'Faturado'?></td>
                <td><?= $lista['HORULTIMAALTERACAO'] ?></td>
            </tr>
    
    <?php

    endforeach;


?>