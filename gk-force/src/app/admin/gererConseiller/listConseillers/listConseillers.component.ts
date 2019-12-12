import{Component, OnInit} from '@angular/core';
import { ConseillerService } from 'src/app/services/ConseillerService';
import { Conseiller } from 'src/app/modeles/Conseiller';
import { Message } from '@angular/compiler/src/i18n/i18n_ast';

@Component({
  selector: 'listConseillers',
  templateUrl: './listConseillers.component.html',
  styleUrls: ['./listConseillers.component.scss'],
})

export class ListConseillersComponent implements OnInit {
  [x: string]: any;
  pageTitle: string= 'Liste Conseillers';
_listFiltrer:string = '';
get listFiltrer():string{
  return this._listFiltrer;
}
set listFiltrer(value: string){
  this._listFiltrer= value;
  this.filtrerConseillers= this.listFiltrer?this.performFiltrer(this.listFiltrer):this.conseillers;
}

filtrerConseillers: Conseiller[]=[];
  conseillers: Conseiller[]=[];

constructor( private conseillerService:ConseillerService) {

 }

 performFiltrer(filtrerPar:string):Conseiller[]{
   filtrerPar=filtrerPar.toLocaleLowerCase();
   return this.conseillers.filter((conseiller:Conseiller)=>
   conseiller.nom.toLocaleLowerCase().indexOf(filtrerPar)!==-1) ;
 }

 ngOnInit(): void {
    this.conseillerService.getObservableConseillers().subscribe({
    next: conseillers=>{
      this.conseillers=conseillers;
      this.filtrerConseillers=this.conseillers;
    },});
  }
}
