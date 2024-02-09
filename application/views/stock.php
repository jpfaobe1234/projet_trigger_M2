<?php foreach ($data as $row):
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h1>
                                <?= strtoupper($row->titre) ?> 

                            </h1>
                        </div>               
                        <div class="card-body" id="cart">
                            <a href="<?php echo site_url('detailAccueil/'.$row->id.'/'.$info) ?>">
                                <button class="btn-detail">
                                    <i class="fas fa-info-circle"></i> Voir Détail
                                </button>
                            </a>
                            <?php
                                $fichiers = explode(',', $row->piece_jointe);
                                foreach ($fichiers as $fichier) {
                                    $resume = formaterText($row->resume);
                            ?>
                            <img src="<?php echo base_url("uploads/".$fichier); ?>" alt="" class="img-fluid">
                            <?php   
                                break;                   
                                } 
                            ?>
                        </div>
                        <div class="card-footer">
                            <p style=""><?= ($resume) ?></p>
                        </div>
                    </div>

            <?php endforeach ?>