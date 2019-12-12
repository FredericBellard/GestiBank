import { Component, OnInit } from '@angular/core';
import{DetailsDemande} from "../modeles_demandes/DetailsDemandes"
import{DetailsDemandesService} from "../services_demandes/DetailsDemandesServices"
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-details-demande',
  templateUrl: './details-demande.component.html',
  styleUrls: ['./details-demande.component.scss'],
  providers:[DetailsDemandesService]
})
export class DetailsDemandeComponent implements OnInit {
  detailsDemandes:DetailsDemande[];
  ref_demande; 

  constructor(private serviceDetailsDemande:DetailsDemandesService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture à partir de l'url 
    this.ref_demande=this.route.snapshot.params['ref'];
    //call de la fonction de recherche 
    this.getDetailsDemandes(this.ref_demande);
  }

  getDetailsDemandes(ref_demande){
    this.serviceDetailsDemande.findDemandebyRefDemande(ref_demande).subscribe(
      detailsDemande => {this.detailsDemandes = detailsDemande;}
    );
  }
}
