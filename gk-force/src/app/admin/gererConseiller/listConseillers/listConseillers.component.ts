
import{Component, OnInit} from '@angular/core';

@Component({
  selector: 'listConseillers',
  templateUrl: './listConseillers.component.html'
})

export class ListConseillersComponent implements OnInit {
pageTitle: string= 'Liste Conseillers';
conseillers: any[] =[
  {
    "conseillerMle":"123",
    "conseillerNom": "Blanc",
    "conseillerPrenom": "Ion"
  },
  {
    "conseillerMle":"124",
    "conseillerNom": "Noir",
    "conseillerPrenom": "Ileana"
  }
];
constructor() { }
  ngOnInit() {
}

public createConseiller() {
  alert('ALoooooo');
} 

}
  

