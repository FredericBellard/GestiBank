import { Component, OnInit } from '@angular/core';
import { Utilisateur } from 'src/app/modeles/Utilisateur';
import { ConseillerService } from 'src/app/services/ConseillerService';
import { Conseiller } from 'src/app/modeles/Conseiller';

@Component({
  selector: 'creerConseiller',
  templateUrl: './creerConseiller.component.html',
  styleUrls: ['./creerConseiller.component.scss'],
})

export class CreerConseillerComponent implements OnInit {
  conseiller: Conseiller;
  pageTitle: string = 'Creation Conseiller';


  constructor(private service : ConseillerService) { }
  ngOnInit() {
    this.conseiller = new Conseiller(-1, 0, '', new Utilisateur(-1, "", "", "", "", "", 1));
  }

  creerConseiller() {
    console.log('start creerConseiller conseiller');
    this.service.saveConseiller(this.conseiller).subscribe(resp => console.log(resp));
  }
}
