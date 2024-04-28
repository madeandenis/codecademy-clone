
/**
*  Catalog Page 
*/
// Sidebar filter -> checkboxes
document.addEventListener('DOMContentLoaded', () => {
    const customCheckboxes = document.querySelectorAll('.custom-checkbox');
  
      customCheckboxes.forEach(checkbox => {
          checkbox.addEventListener('click', () => {
              checkbox.classList.toggle('checked');
          });
      });
  
})

var allCourses = [];
var displayedCourses = [];

function displayByLevel(courses, level) {
    const filteredCourses = [];
    courses.forEach(course => {
        let courseDifficultyElement = course.querySelector('.course-difficulty');
        let courseDifficultyText = courseDifficultyElement.textContent.trim().toLowerCase();
        
        if (level === 'beginner' && courseDifficultyText === 'beginner friendly') {
            filteredCourses.push(course);
        } 
        else if (level === 'intermediate' && courseDifficultyText === 'intermediate') {
            filteredCourses.push(course);
        } 
        else if (level === 'advanced' && courseDifficultyText === 'advanced') {
            filteredCourses.push(course);
        }
    });
    return filteredCourses;
}

function displayByPrice(courses, price){
    const filteredCourses = [];
    courses.forEach(course => {
        let courseTypeElement = null;
        if(price === 'free'){
            courseTypeElement = course.querySelector('.course-type-free');
        }
        else if(price === 'paid'){
            courseTypeElement = course.querySelector('.course-type-paid');
        }
        if (courseTypeElement){
            filteredCourses.push(course);
        }  
    });
    return filteredCourses;
}

function displayByLessonCount(courses,lesson_count_param){
    const filteredCourses = [];
    courses.forEach(course => {
        let courseLessonsElement = course.querySelector('.lesson-count');
        let courseLessonsText = courseLessonsElement.textContent.trim().toLowerCase();
        let courseLessonsCount = parseInt(courseLessonsText);

        switch (lesson_count_param) {
            case 'less_than_5':
                if (courseLessonsCount < 5) {
                    filteredCourses.push(course);
                }
                break;
            case '5_to_10':
                if (courseLessonsCount >= 5 && courseLessonsCount < 10) {
                    filteredCourses.push(course);
                }
                break;
            case '10_to_20':
                if (courseLessonsCount >= 10 && courseLessonsCount < 20) {
                    filteredCourses.push(course);
                }
                break;
            case '20_to_60':
                if (courseLessonsCount >= 20 && courseLessonsCount < 60) {
                    filteredCourses.push(course);
                }
                break;
            case '60_plus':
                if (courseLessonsCount >= 60) {
                    filteredCourses.push(course);
                }
                break;
            default:
                break;
        }
    });
    return filteredCourses;
}

function applyFilters() {
    const levelFilterElement = document.querySelector('.custom-checkbox.checked[data-filter="level"]');
    const priceFilterElement = document.querySelector('.custom-checkbox.checked[data-filter="price"]');
    const lessonCountFilterElement = document.querySelector('.radio-wrapper input[name="lessons"]:checked');
    
    let levelFilter, priceFilter, lessonCountFilter;
    
    let filteredCourses = allCourses.slice();

    if (levelFilterElement) {
        levelFilter = levelFilterElement.getAttribute('data-value');
        filteredCourses = displayByLevel(filteredCourses, levelFilter);
    } 
    
    if (priceFilterElement) {
        priceFilter = priceFilterElement.getAttribute('data-value');
        filteredCourses = displayByPrice(filteredCourses, priceFilter);
    }
    
    if (lessonCountFilterElement) {
        lessonCountFilter = lessonCountFilterElement.getAttribute('data-value');
        filteredCourses = displayByLessonCount(filteredCourses, lessonCountFilter);
    }

    displayCourses(filteredCourses);
}
function clearFilters(){
    const checkboxes = document.querySelectorAll('.custom-checkbox.checked');

    checkboxes.forEach(checkbox => {
        checkbox.classList.remove('checked');
    });

    const radioButtons = document.querySelectorAll('.radio-wrapper input[type="radio"]:checked');

    radioButtons.forEach(radioButton => {
        radioButton.checked = false;
    });

    applyFilters();
}

function displayCourses(courses){
    coursesContainer = document.querySelector('.courses-container');
    coursesContainer.innerHTML = ''

    courses.forEach(course => {
        coursesContainer.appendChild(course); 
    });
}

document.addEventListener('DOMContentLoaded', function loadCourses() {
    callGetAPI('getCourses', {count: 'all'}, function(responseCourses) {
        responseCourses.forEach(course => {
            const courseElement = document.createElement('div');
            courseElement.innerHTML = course;

            allCourses.push(courseElement);
        });
        displayCourses(allCourses);
    });
})

function callGetAPI(action, params, callback){
    apiUrl = '/api/' + action;
    
    if (params && Object.keys(params).length > 0) {
        apiUrl += '?';
    
        const queryParams = [];
    
        Object.keys(params).forEach(key => {
            const encodedKey = encodeURIComponent(key); 
            const encodedValue = encodeURIComponent(params[key]); 
            queryParams.push(`${encodedKey}=${encodedValue}`); 
        });
    
        apiUrl += queryParams.join('&');
    }
    

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            callback(data);
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}

