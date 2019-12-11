import { Component, OnInit } from '@angular/core';
import{Demande} from "../modeles_conseiller/demandes"
import{DemandesService} from "../services_conseiller/DemandesService"

@Component({
  selector: 'app-list-demandes',
  templateUrl: './list-demandes.component.html',
  styleUrls: ['./list-demandes.component.scss'],
  providers:[DemandesService]
})
export class ListDemandesComponent implements OnInit {
  private demandes:Demande[];
  
  constructor(private serviceDemande:DemandesService) { }

  ngOnInit() {
    this.getAllDemandes();
  }

  getAllDemandes(){
    this.serviceDemande.findAll().subscribe(
      demande => {this.demandes = demande;}
    );
  }
}
