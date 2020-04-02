import { mount, createLocalVue } from '@vue/test-utils';
import BootstrapVue from 'bootstrap-vue';
import PCategoriesTable from '@/components/PCategoriesTable.vue';
import axios from "axios";

jest.mock('axios');

const localVue = createLocalVue();
localVue.use(BootstrapVue);

describe('PCategoriesTable', () => {
  it('fetches successfully data', () => {
    const data = {
      data: {
        categories: [
          {
            id: '1',
            name: 'General',
            description: 'General description',
            iva: 0.19
          },
          {
            id: '2',
            name: 'Exento',
            description: 'productos exentos',
            iva: 0
          },
        ],
      },
    };

    wrapper = mount(PCategoriesTable, {
      localVue
    });

    axios.get.mockImplementationOnce(() => Promise.resolve(data));
    categories = wrapper.vm.categories;

    expect(categories).toEqual(data)
  })
})