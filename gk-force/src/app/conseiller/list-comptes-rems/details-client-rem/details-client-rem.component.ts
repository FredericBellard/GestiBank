import { Component, OnInit } from '@angular/core';
import{DetailsClientRem} from "../modeles_comptes_rems/DetailsClientsRem"
import{DetailsClientRemService} from "../services_comptes_rems/DetailsClientsRemsServices"
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-details-client-rem',
  templateUrl: './details-client-rem.component.html',
  styleUrls: ['./details-client-rem.component.scss'],
  providers:[DetailsClientRemService]
})
export class DetailsClientRemComponent implements OnInit {
  detailsClientsRem:DetailsClientRem[];
  id_compte; 

  constructor(private serviceDetailsClientRem:DetailsClientRemService, private route:ActivatedRoute) { }

  ngOnInit() {
    //lecture apartir de l'url 
    this.id_compte=this.route.snapshot.params['id'];
    //call de la fonction de recherche 
    this.getDetailsClientsRem(this.id_compte);
  }

  getDetailsClientsRem(id_compte_rem){
    this.serviceDetailsClientRem.findClientRembyIdCompte(id_compte_rem).subscribe(
      detailsClientRem => {this.detailsClientsRem = detailsClientRem;}
    );
  }
}
