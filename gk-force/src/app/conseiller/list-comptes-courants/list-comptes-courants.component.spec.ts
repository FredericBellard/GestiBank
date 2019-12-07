import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListComptesCourantsComponent } from './list-comptes-courants.component';

describe('ListComptesCourantsComponent', () => {
  let component: ListComptesCourantsComponent;
  let fixture: ComponentFixture<ListComptesCourantsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListComptesCourantsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListComptesCourantsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
