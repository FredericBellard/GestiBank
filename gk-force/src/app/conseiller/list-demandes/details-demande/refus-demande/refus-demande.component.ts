import { Component, OnInit } from '@angular/core';
import{ RefusCompteCourant } from "../modeles_traitements_demandes/RefusDemandeCompteCourant"
import{ RefusDemandeCompteCourantService } from "../services_traitements_demandes/RefusCompteCourantServices"
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-refus-demande',
  templateUrl: './refus-demande.component.html',
  styleUrls: ['./refus-demande.component.scss'],
  providers:[RefusDemandeCompteCourantService]
})
export class RefusDemandeComponent implements OnInit {
  private refusDemande : RefusCompteCourant[];
  private ref_demande;

  constructor(private serviceRefus : RefusDemandeCompteCourantService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture à partir de l'url 
    this.ref_demande=this.route.snapshot.params['ref'];
    //call de la fonction delete
    this.delDemande(this.ref_demande);
  }

  delDemande(ref_demande){
    this.serviceRefus.deleteDemande(ref_demande).subscribe(
      refusDemande => {this.refusDemande = refusDemande;}
    );
  }

}
