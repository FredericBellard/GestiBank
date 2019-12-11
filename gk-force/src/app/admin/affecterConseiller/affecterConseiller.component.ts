import{Component, OnInit} from '@angular/core'
import{Demande} from "../../conseiller/modeles_conseiller/Demandes"
import{DemandesService} from "../../conseiller/services_conseiller/DemandesService"
import { Conseiller } from 'src/app/modeles/Conseiller';
import { ConseillerService } from 'src/app/services/ConseillerService';

@Component({
  selector: 'affecterConseiller',
  templateUrl: './affecterConseiller.component.html',
  styleUrls: ['./affecterConseiller.component.scss'],
  providers:[DemandesService]
})

export class AffecterConseillerComponent implements OnInit {
pageTitle: string= 'Affectation';
demandes:Demande[];
conseillers:Conseiller[];

  constructor(private serviceDemande:DemandesService, private conseillerService:ConseillerService) { }
  
  ngOnInit() {
    this.getAllDemandes();
  }

  getAllDemandes(){
    this.serviceDemande.findAll().subscribe(
      demande => {
        this.demandes = demande;
        this.getAllConseillers();
      }
    );
  }

  getAllConseillers() {
    this.conseillerService.findAll().subscribe(
        conseillers =>{
          this.conseillers=conseillers;
          this.setSelectedConseiller();
        }
    );
  }

  private setSelectedConseiller() {
    console.info("Number of conseillers: " + this.conseillers.length);
    console.info("Number of demandes: " + this.demandes.length);
    this.demandes.forEach(d => {
      this.conseillers.forEach( c=> {
        if(c.id_conseiller == d.id_conseiller)
        d.selectedConseiller = c;
      });
    });
  }

  affecterConseiller(d: Demande) {
    console.info("Conseiller: " + d.selectedConseiller.id_conseiller);
    if(d.selectedConseiller){
      d.id_conseiller = d.selectedConseiller.id_conseiller;
    }
    this.serviceDemande.update(d).subscribe();
  }
}
