## <a name="tech">Technical Questions</a>
Please answer the following questions in a markdown file called `Answers to technical questions.md`.

- How long did you spend on the coding test? What would you add to your solution if you had more time? If you didn't spend much time on the coding test then use this as an opportunity to explain what you would add.

  Answer: I spent around 8 hours to done a test. If I had more time, I would add for_rent status filter that I have misunderstood at first and would try to refactor code to be more clean and fast. And make some more test cases.
- What was the most useful feature that was added to the latest version of your chosen language? Please include a snippet of code that shows how you've used it.

  Answer: The most useful feature in my project is How I manage filter in frontend. I make it as data and loop to fetch them. I think it's make my code more clean and easy to manage.
  
```
  sorts: [
    { id: 1, title: 'Price: low-high', value: 'price-low-to-high' },
    { id: 2, title: 'Price: high-low', value: 'price-high-to-low' },
    { id: 3, title: 'Title: a-z', value: 'title-a-to-z' },
    { id: 4, title: 'Title: z-a', value: 'title-z-to-a' },
  ],

```
```
  <div class="flex flex-wrap">
      <button
        v-for="sort in sorts"
        :key="sort.id"
        :class="
         sort.value === activeSort
        ? 'px-4 py-2 mb-2 mr-2 font-semibold  rounded shadow-md focus:outline-none bg-purple-500 text-white'
        : 'px-4 py-2 mb-2 mr-2 font-semibold text-gray-600 bg-gray-300 rounded shadow-md focus:outline-none hover:bg-purple-500 hover:text-white'
        "
        type="button"
        @click="selectActiveSort(sort)"
       >
          {{ sort.title }}
       </button>
  </div>
```
- How would you track down a performance issue in production? Have you ever had to do this?

  Answer: We can track down performances issue in many ways. I have done only light house to improve my website performance, But if I had to track the performances, I would
  
  1.Use load test tool such as JMeter

  2.Use monitoring tool such as Prometheus and Grafana

  3.Use Google page speed and Light house
