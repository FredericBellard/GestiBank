import { Component, OnInit } from '@angular/core'
import{Demande} from "../modeles_conseiller/demandes"
import{DemandesService} from "../services_conseiller/DemandesService"
import { ConseillerService } from 'src/app/services/ConseillerService';
import { Conseiller } from 'src/app/modeles/Conseiller';

@Component({
  selector: 'app-list-demandes',
  templateUrl: './list-demandes.component.html',
  styleUrls: ['./list-demandes.component.scss'],
  providers:[DemandesService]
})
export class ListDemandesComponent implements OnInit {
  demandes:Demande[];
  
  constructor(private serviceDemande:DemandesService) { }

  ngOnInit() {
    this.getAllDemandes();
  }

  getAllDemandes(){
    this.serviceDemande.findAll().subscribe(
      demandes => {this.demandes = demandes; }
    );
  }
}
