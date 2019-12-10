import { Component, OnInit } from '@angular/core';
import{ValidationCompteCourant} from "../modeles_traitements_demandes/TraitementDemandeCompteCourant"
import{TraitementDemandeCompteCourantService} from "../services_traitements_demandes/TraitementDemandeCompteCourantServices"
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-traitement-demandes-comptes',
  templateUrl: './traitement-demandes-comptes.component.html',
  styleUrls: ['./traitement-demandes-comptes.component.scss'],
  providers:[TraitementDemandeCompteCourantService]
})
export class TraitementDemandesComptesComponent implements OnInit {
  private validationDemande : ValidationCompteCourant[];
  private ref_demande;

  constructor(private serviceValidation : TraitementDemandeCompteCourantService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture apartir de l'url 
    this.ref_demande=this.route.snapshot.params['ref'];
    //call de la fonction de recherche 
    this.getValidation(this.ref_demande);
  }
  getValidation(ref_demande){
    this.serviceValidation.findValidation(ref_demande).subscribe(
      validationsDemande => {this.validationDemande = validationsDemande;}
    );
  }
}
