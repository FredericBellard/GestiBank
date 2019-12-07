import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListComptesRemsComponent } from './list-comptes-rems.component';

describe('ListComptesRemsComponent', () => {
  let component: ListComptesRemsComponent;
  let fixture: ComponentFixture<ListComptesRemsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListComptesRemsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListComptesRemsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
